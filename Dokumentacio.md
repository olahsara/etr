# etr
Az elkészített alkalmazás a Neptun mintájára készült. 
Az oldal megnyitásakor egy bejelentkező felület fogadja a felhasználót, ahova egy felhasználónév(neptun kód) és egy hozzá tartozó jelszó párossal tud bejelentkezni. 3 fő felhasználói kör van: adminisztrátori, oktatói és hallgatói:
### Adminisztrátor
Az adminisztrátor tudja módosítani csak a felhasználók személyes adatait, mint például felhasználónév, jelszó, emberek neve, oktatók beosztása, a hallgatók félévére vonatkozó adatot. Ehhez a felületen megjelenő táblázat áll segítségére. Az alkalmazás szintér részében is ő tudja moderálni a hozzászólásokat. Egyes személyes, nem mindenkire tartozó lekérdezéseket is csak ő hajthat végre, mint a diákok vizsgáit illető információk lekérése. Ugyanakkor az adminisztrátor tudja csak az oktatókat kurzusokhoz rendelni. Tudják módosítani az órarendet a többi átlagos (oktatók, hallgatók) számára, úgy szintén a felületen található űrlap segítségével.
### Oktató
Az oktatók láthatják a kurzusaira járó hallgatók adatait. Tudják a hallgatókat vizsgákhoz illetve kurzusokhoz rendelni. Ezt úgy tehetik meg, ha a megfelelő menüpontban 2 legördülő menüből kiválasztják a kívánt hallgatót és a kívánt kurzust, majd a “Hozzáad” gomb megnyomása után felveheti a hallgatót a kurzusra. Ezt követően megjelenik az oldalon egy lista, ami tartalmazza az adott kurzuson lévő hallgatókat, mellette egy “Törlés a kurzusról” gombbal. Ugyanitt elérhetővé válik számukra a hallgatók érdemjegyeinek módosítása vagy létrehozása opció is. Továbbá használhatják a szinteret megtekinthetik az órarendjüket. Ezt a “Kurzusok” oldalon tehetik meg. 
### Hallgató
A hallgatók bejelentkezés után láthatják a saját adataikat, valamint a tanulmányaikkal kapcsolatos információkat, mint például a szakjukra vonatkozó adatokat. Tudnak felvenni és leadni kurzusokat, valamint megnézhetik az órarendjüket is. Látják még az egyes felvett kurzusokra vonatkozó adatokat is: kurzuskód, kurzusnév, és a teljesítés állapotát. Hozzáférnek a tanulmányi átlagokhoz is, láthatja a hagyományos átlagot, súlyozott átlagot. Használhatják a rendszer által nyújtott szintér funkciót is.



