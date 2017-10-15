
<section class="section">
<div class="container">

<h1 class="title">Remserver</h1>

<p class="subtitle">En kort dokumentation</p>

<p>Detta är en mockup-server för utveckling av applikationer som jobbar mot ett REST API. Det finns ett default dataset som du kan testa.</p>

<br>

<p class="subtitle">Följande anrop kan du använda</p>


<p>Hämta datasetet..</p>

```text
GET /api/[dataset]
```
<p>Exempel, <a href=api/users>api/users</a></p>
<br>
<p>..eller delar av det. (Default är offset=0 och limit=25)</p>

```text
GET /api/users?offset=[X]&limit=[Y]
```
<p>Exempel, <a href=api/users?offset=3&limit=5>api/users?offset=3&limit=5</a></p>
<br>
<p>Hämta en post, utifrån id.</p>

```text
GET /api/users/[id]
```
<p>Exempel, <a href=api/users/7>api/users/7</a></p>
<br>
<p>Lägg till en ny post i dataset. Datasetet skapas om det inte finns, och ger ett id till posten.</p>

```text
POST /api/[dataset]
{"some": "thing"}

POST /api/users
{"firstName": "Mickey", "lastName": "Mouse"}
```

<p>Resultat:</p>

```json
{
    "some": "thing",
    "id": 1
}

{
    "firstName": "Mickey",
    "lastName": "Mouse",
    "id": 13
}
```

<br>
<p>Skapa post med id, om den inte redan finns, annars uppdatera befintlig post. Datasetet skapas om det inte redan finns.</p>

```text
PUT /api/[dataset]/1
{"id": 1, "other": "thing"}

PUT /api/users/13
{"id": 13, "firstName": "Minnie", "lastName": "Mouse"}
```

Resultat:

```json
{
    "other": "thing",
    "id": 1
}

{
    "id": 13,
    "firstName": "Minnie",
    "lastName": "Mouse"
}
```
<br>

<p>Ta bort en post.</p>

```text
DELETE /api/[dataset]/1

DELETE /api/users/13
```

<p>Resultatet blir alltid `null`.</p>

<br>



<p>Källkoden finns på GitHub: <a href="https://github.com/dbwebb-se/rem-server">dbwebb-se/rem-server</a>.





</div>
</section>
