<html>
    <head>
        <link rel="stylesheet" href="style.css"type="text/css"/>
    </head>
<body>
    <div class ="gauche">
        <form method="post">
            <fieldset><legend>Selectionner</legend>
                <br><input list="titrejeu" type="text"  name="titrejeux"/>
                    <datalist id="titrejeu">
                        <option>jeux 1</option>
                        <option>jeux 2</option>
                        <option>jeux 3</option>
                    </datalist>
                <br><br>
                <button class="tri">SELECT<BUTTON>
            </fieldset>
            
            
        </form>    
    </div>
    <div class="droite">
    <table class="bas">
        <thead>
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <th>User</th>
                </tr>
        </thead>
        <tr>
        <form method="post">
        <td><input type="text" name="titre"/></td>
        <td><input type="number" name="temps"/></td>
        <td><input type="number" name="difficulte"/></td>
        <td><div>
                <input type="radio" name="multi" value="oui" /> <label>oui</label><br />
                <input type="radio" name="multi" value="non" /> <label>non</label><br />
            </div>
        </td>
        <td><div>
                <input type="radio" name="console" value="psvivta" /> <label>Psvita</label><br />
                <input type="radio" name="console" value="ps3" /> <label>Ps3</label><br />
                <input type="radio" name="console" value="ps4" /> <label>Ps4</label><br />
            </div></td>
        <td>
            <div>
                    User
            </div>   
        </td>
        </form>
        </tr>
    </table>
    </div>
    </div>
    <button type="submit" class="modifier">Modifier</button>
</body>
</html>


