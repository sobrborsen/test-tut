# Øvelse i at lave test kode

## Appen
Dette er en standard Laravel applikation, og det den kan, er at vende det indtastede ord om, så fx. "hej" bliver til "jeh".

Den kan afprøves ved at `make serve` og rette browseren mod `http://localhost:8000`

Formålet er denne app er at vise, hvordan du kan teste sådan et system og integrerer det med github.

Du kan kører testen med `make test` og du tjekke hvor godt din koden er dækket
af tests med `make coverage`. 
En mere detaljeret dækning fås med `make coverage-html`, hvorefter
du kan åbne `build/index.html` i browseren, og få mange flere
informationer om din testdækningen.

## Opgaven
Endepunktet er: `/reverse?text=<bruger input>[&service=local|laravel|guzzle]`

`service` parameteren kan ikke bruges i browseren, da det er en fiktiv service, men man kan godt teste op i mod den.

Hvis request parameteren `json == 1` får man json data tilbage.

Opgaven er at ændre følgende regler:
 - `text` skal være mindst 4 tegn og max 20 tegn og hvis `text` ikke er indenfor dette interval, vises en fejlmeddelse
 - når `text` er 'hello' og `service` er:
    - `local` eller ikke angivet, skal den svarer med `Hi, I am local`
    - `laravel`, skal den svarer med `Hi, I am laravel`
    - `guzzle`, skal den svarer med `Hi, I am guzzle`

Check ud fra `develop` og lav din løsning i `feature/<user>` og når du er
færdig laver du en PR med `sobr` som reviewer.

## Generelt om tests

Hvorfor overhovedet test din kode? Min påstand er at:
 - du sikre at koden opfører sig som tænkt
 - code coverage tjekker om du har kode som ikke er testet og dermed en mulig fejlkilde
 - sikre fremtidige ændringer og refaktoreringer stadigvæk har det ønskede resultat
 - du hjælper din kollega, så vedkommende ikke kommer til at lave utilsigtede fejl når koden skal ændres
 - større sikkerhed ved automatisk deployment
 
 Med i Laravel pakken er der god test faciliteter, selv når man skal snakke med andre remote services.

 Med github actions kan vi kører automatisk test og kode dækning når man merger til develop, og som reviewer tjekker man selvfølelig om alle
 tests kan kører og at test dækningen er 100% :smiley: 

 Hvis man har kode som ikke skal med i test dækningen kan du læse om
 det [her](https://phpunit.readthedocs.io/en/9.5/code-coverage-analysis.html#ignoring-code-blocks) men brug det omtanke det kan skjule potentielle fejl.


