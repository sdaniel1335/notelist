# Notelist

VC Framework 0.1.0 alapú, egyszerű szöveges jegyzetkezelő PHP 5.3–8.x környezethez.

- B, P és W listák; az üres listák nem jelennek meg.
- Jegyzet létrehozása, megnyitása, szerkesztése, átnevezése és törlése.
- Jegyzettömb jellegű, formázatlan szövegszerkesztő, kézi mentéssel (Ctrl+S).
- Felhasználónként elkülönített jegyzetek, közös belépés a Lifelist / Playlist / Todolist appokkal.

## Telepítés

1. Helyezd a projektet ugyanazon webhely `notelist` alkönyvtárába, a többi app mellé. Apache és mod_rewrite szükséges; a mellékelt átirányítási fájlokat is másold át.
2. Másold a `private_html/app/config/db-sample.php` fájlt `db.php` néven, és állítsd be a többi app által használt közös adatbázist. Állítsd be a `DB_CHAR` értékét `utf8mb4`-re. Ha van `DB_PREFIX`, az importált táblák neveiben is használd ugyanazt az előtagot.
3. Importáld az `install.sql` fájlt a közös adatbázisba. A meglévő `users` táblát és fiókokat megtartja, a jegyzeteknek `notes` táblát hoz létre. Új alapértelmezett fiókot nem hoz létre.
4. A közös belépéshez egyezzen a PHP session neve, tárolója, cookie domainje és beállítása minden appban. A cookie útvonala `/` legyen, az appok azonos hoston fussanak. A Notelist ugyanazokat az `auth_user_id`, `auth_username` és `_auth_csrf` session kulcsokat használja.
5. Éles környezetben állítsd az `APP_ENV` értékét `prod`-ra. A projekt verziója `0.1.0`.

A `MODULE` jelölőnek köszönhetően a közös felső sáv felismeri az appot. A framework és a közös topbar változatlan.

## Használat

Az „Új jegyzet” gombbal üres lista esetén is létrehozható jegyzet. Adj meg címet, válassz B/P/W listát, majd mentsd a szöveget. A cím átírásával átnevezhető, a lista kiválasztásával áthelyezhető. Üres szöveg is menthető; a cím kötelező, legfeljebb 255 UTF-8 bájt, a tartalom legfeljebb 1 MiB. A törlés végleges.
