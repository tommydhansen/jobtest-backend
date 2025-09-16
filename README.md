# Jobtest – Backendudvikler hos Side-Walk
Først og fremmest tak, fordi du ønsker at deltage i vores rekrutteringsproces.  
Du har nu forket vores Git-repo og er klar til at gå i gang med testen.

---

## Tidsforbrug
- Du må maksimalt bruge **3,5 time** på testen.
- Brug din tid klogt – vi vurderer både kvalitet, struktur og prioritering.

---

## Aflevering
- Upload din løsning til en **public fork** af repoet.
- Send os et link til din fork

---

## Opsætning af testmiljø (se pkt. "Alternativt miljø")

Projektet er sat op til Docker. Følg disse trin for at komme i gang:

1. Kopiér `.env.docker.example` til `.env`.
2. Tilføj `http://jobtest.test` i din hosts-fil, så du kan tilgå applikationen.
3. Kør:

``` 
docker compose up
```

log derefter ind i containeren og kør

```
composer install
npm install
npm run dev
php artisan key:generate
php artisan migrate
php artisan db:seed
```

4. Applikationen kører nu på: http://jobtest.test
5. Log ind med:
- Brugernavn: test@test.test
- Kodeord: Test123

## Alternativt miljø
Ønsker du at bruge et andet setup (fx Laravel Herd eller dit eget dev-miljø), er du velkommen – men sørg for, at alt virker inden du starter testen.

## Test/Opgave
Du skal løse 3 opgaver og besvare nogle spørgsmål. Rækkefølgen er op til dig.

### Opgave 1 – Relationer
Sæt relationerne korrekt op mellem følgende modeller:
- User og Project
- Project og Comment

### Opgave 2 – Controller-optimering
- Gennemgå og optimer `ProjectController`.

### Opgave 3 – Fejlfinding
- I projektet er der bevidst lavet to fejl, som hænger sammen.

### Teoretiske spørgsmål

Besvar nedenstående spørgsmål direkte i denne **README.md** under hvert spørgsmål.

---

**Spørgsmål 1:**  
Forklar, hvad en **morph relation** er i Laravel, og giv et eksempel på en situation, hvor den er nyttig.

*En morph relation betyder at en relation kan bestå af forskellige Modeler. F.eks. hvis man har en fil uploader, hvor der bliver gjort forskel på filtype (dokumenter, billeder, videoer), kan man lave en morph relation sådan at hver filtype har sin egen model og tabel, men stadig fremgår i den samme relation collection "files"*

---

**Spørgsmål 2:**  
Du har en database med mange relationer, hvor `Company` er den centrale model.  
Hvordan sikrer du, at tilhørende data i relationsmodellerne slettes korrekt, når du sletter en virksomhed?

*Det kan gøre på forskellige måder.*
* Man kan sætte Cascading Deletes på Foreign Keys, sådan at når man sletter en "Company" som andre ting der relatere til den via en foreign key "company_id", så bliver disse også slettet.
* Man kan sætte en "deleting" event på Company modelen, hvis man definere hvad der også skal slettes, når en Company slettes.
* Til sidst kan man altid lave en manuel sletning, hvor man har en delete method på modeln, som sørger for at slette alle relationer, inden den centrale model slettes, Eller man kan lave en service klasse og metode til det.


---

**Spørgsmål 3:**  
Når du skal lave funktionskode (fx databehandling på en model, inden den sendes til et view), hvor bør denne kode placeres – og hvorfor?

*Logikken kunne laves i den controller der sørger for at sende data til view'et. Men jeg ville vælge at lave en service klasse for den givne model, hvor jeg kan have alt logic af databehandling. Så bliver jeg fri for at have en "tyk" controller"*

*Hvis jeg skulle gå skridtet videre, ville jeg overveje om der også var brug for et repository, hvor jeg skrive alle metoder der indeholder database-kald, sådan at jeg for en opdeling af hvad der håndtere formidling af data (controlleren), håndtering af data (servicen), og hentning og gemning af data (repositoryet).*

---

**Spørgsmål 4:**  
Du skal arbejde på en applikation uden et PHP-framework.  
Hvordan ville du håndtere oprettelse af et inputfelt og gemme data i databasen – og hvilke overvejelser skal du gøre dig ift. sikkerhed og struktur?

*Til at gemme data i database ville jeg bruge prepared statements med enten mysqli eller PDO, sådan at alt rå data komme igennem et tjek for skadelige tegn, for at sikre mod sql injection*

*Til validering af data, vil jeg gøre brug af et data object, hvis muligt, som repræsentere den data jeg har sendt fra formen.*\
*Hvis jeg f.eks. havde en form med en title, en alder input, og en option af hvilken landsdel jeg bor i, ville jeg lave følgende klasse*
```
class formData {
    public function __construct(
        public string $title,
        public int $age,
        //Enum
        public CountryRegion $region,
    )
}
```

*På den måde kan jeg få en klasse til at validere min data.*\
*Hvis det ikke er muligt at bruge en klasse, ville jeg sørge for at validere min data ved at tjekke dataens type manuelt for at sikre mig at jeg ikke prøver at indæstte en string i et int field.*

## Efter aflevering af testen
Vi gennemgår din løsning hurtigst muligt og giver dig derefter feedback på din besvarelse.  
Vi glæder os til at modtage din besvarelse.
