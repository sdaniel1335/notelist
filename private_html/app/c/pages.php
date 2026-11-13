<?php
class pages extends App
{
  public function index()
  {
    $user_id = auth_user_id();
    $stmt = $this->db->prepare('SELECT id, list_key, title FROM ' . $this->table('notes') . ' WHERE user_id=? ORDER BY title, id');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($id, $list_key, $note_title);
    $groups = array('B' => array(), 'P' => array(), 'W' => array());
    while ($stmt->fetch()) {
      if (isset($groups[$list_key])) { $groups[$list_key][] = array('id' => $id, 'title' => $note_title); }
    }
    $stmt->close();
    $this->set(array('title' => APP_TITLE, 'groups' => $groups));
    $this->render('pages/index');
  }
  private function find_note($id)
  {
    $user_id = auth_user_id();
    $stmt = $this->db->prepare('SELECT id, list_key, title, content FROM ' . $this->table('notes') . ' WHERE id=? AND user_id=?');
    $stmt->bind_param('ii', $id, $user_id);
    $stmt->execute();
    $stmt->bind_result($note_id, $list_key, $note_title, $content);
    $found = $stmt->fetch();
    $stmt->close();
    if (!$found) { header('HTTP/1.1 404 Not Found'); die('A jegyzet nem található.'); }
    return array('id' => $note_id, 'list_key' => $list_key, 'title' => $note_title, 'content' => $content);
  }
  public function edit()
  {
    $id = isset($_GET['id']) && is_string($_GET['id']) ? (int) $_GET['id'] : 0;
    $list_key = isset($_GET['list']) && in_array($_GET['list'], array('B', 'P', 'W'), true) ? $_GET['list'] : 'B';
    $note = $id ? $this->find_note($id) : array('id' => 0, 'list_key' => $list_key, 'title' => '', 'content' => '');
    $this->set(array('title' => $id ? $note['title'] : 'Új jegyzet', 'note' => $note, 'error' => ''));
    $this->render('pages/edit');
  }
  public function save()
  {
    $this->require_csrf();
    $id = (int) $this->post_text('id');
    if ($id) { $this->find_note($id); }
    $note_title = trim($this->post_text('title'));
    $list_key = $this->post_text('list_key');
    $content = $this->post_text('content');
    if ($note_title === '' || strlen($note_title) > 255 || strlen($content) > 1048576 || !in_array($list_key, array('B', 'P', 'W'), true)) {
      header('HTTP/1.1 422 Unprocessable Entity');
      $this->set(array('title' => 'Jegyzet', 'note' => array('id' => $id, 'title' => $note_title, 'list_key' => $list_key, 'content' => $content), 'error' => 'Adj meg egy címet (legfeljebb 255 bájt), B/P/W listát és legfeljebb 1 MiB szöveget.'));
      $this->render('pages/edit');
      return;
    }
    $user_id = auth_user_id();
    if ($id) {
      $stmt = $this->db->prepare('UPDATE ' . $this->table('notes') . ' SET list_key=?, title=?, content=? WHERE id=? AND user_id=?');
      $stmt->bind_param('sssii', $list_key, $note_title, $content, $id, $user_id);
    } else {
      $stmt = $this->db->prepare('INSERT INTO ' . $this->table('notes') . ' (user_id, list_key, title, content) VALUES (?,?,?,?)');
      $stmt->bind_param('isss', $user_id, $list_key, $note_title, $content);
    }
    $stmt->execute();
    $stmt->close();
    $this->flash('success', 'Jegyzet mentve.');
    $this->redirect('/');
  }
  public function delete()
  {
    $this->require_csrf();
    $id = (int) $this->post_text('id');
    $this->find_note($id);
    $user_id = auth_user_id();
    $stmt = $this->db->prepare('DELETE FROM ' . $this->table('notes') . ' WHERE id=? AND user_id=?');
    $stmt->bind_param('ii', $id, $user_id);
    $stmt->execute();
    $stmt->close();
    $this->flash('success', 'Jegyzet törölve.');
    $this->redirect('/');
  }
}
