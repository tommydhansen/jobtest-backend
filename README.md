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

## Regler
- Du må **ikke bruge ChatGPT eller anden AI** til løsning af opgaven.
- Du må gerne benytte dokumentation, officielle guides og almindelige ressourcer (StackOverflow, Laravel docs, PHP docs, osv.).

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

*Indsæt svar her*  

---

**Spørgsmål 2:**  
Du har en database med mange relationer, hvor `Company` er den centrale model.  
Hvordan sikrer du, at tilhørende data i relationsmodellerne slettes korrekt, når du sletter en virksomhed?

*Indsæt svar her*

---

**Spørgsmål 3:**  
Når du skal lave funktionskode (fx databehandling på en model, inden den sendes til et view), hvor bør denne kode placeres – og hvorfor?

*Indsæt svar her*

---

**Spørgsmål 4:**  
Du skal arbejde på en applikation uden et PHP-framework.  
Hvordan ville du håndtere oprettelse af et inputfelt og gemme data i databasen – og hvilke overvejelser skal du gøre dig ift. sikkerhed og struktur?

*Indsæt svar her*

## Efter aflevering af testen
Vi gennemgår din løsning hurtigst muligt og giver dig derefter feedback på din besvarelse.  
Vi glæder os til at modtage din besvarelse.
