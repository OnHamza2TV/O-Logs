<?php require '../db/connect.php'; 

$result = mysqli_query($con, "SELECT * FROM `fib`") or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Systeme de Rapport | FIB</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Système de Rapport" />
    <meta property="og:description" content="Ce site permet de faire des rapport de son service !" />
    <meta property="og:imnom" content="../assets/logofib.png" />
    <meta property="og:imnom:width" content="1920" />
    <meta property="og:imnom:height" content="1080" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:label1" content="Écrit par">
    <meta name="twitter:data1" content="OnHamza2TV">
    <meta name="twitter:label2" content="Durée de lecture est.">
    <meta name="twitter:data2" content="0 minute">
    <link rel="shortcut icon" href="../assets/logofib.png" type="imnom/x-icon">
    <link rel="icon" href="../assets/logofib.png" type="imnom/x-icon">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<?php 
if (isset($_POST['submit'])) {
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['discord']) && isset($_POST['arrest']) && isset($_POST['rons']) && isset($_POST['bodycam']) && isset($_POST['prise']) && isset($_POST['fin']) && isset($_POST['pat']) && isset($_POST['rapport'])) {
        $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
        $nom = mysqli_real_escape_string($con, $_POST['nom']);
        $discord = mysqli_real_escape_string($con, $_POST['discord']);
        $arrest = mysqli_real_escape_string($con, $_POST['arrest']);
        $rons = mysqli_real_escape_string($con, $_POST['rons']);
        $bodycam = mysqli_real_escape_string($con, $_POST['bodycam']);
        $prise = mysqli_real_escape_string($con, $_POST['prise']);
        $fin = mysqli_real_escape_string($con, $_POST['fin']);
        $pat = mysqli_real_escape_string($con, $_POST['pat']);
        $rapport = mysqli_real_escape_string($con, $_POST['rapport']);
        $ipremote = mysqli_real_escape_string($con, $_SERVER['REMOTE_ADDR']);
        $confirmation = mysqli_real_escape_string($con, $_POST['confirmation']);
        $date = time();

        mysqli_query($con, "INSERT INTO fib (`prenom`, `nom`, `discord`, `arrest`, `rons`, `bodycam`, `prise`, `fin`, `pat`, `rapport`, `ip`, `date`, `confirmation`) VALUES('$prenom', '$age', '$discord', '$arrest', '$rons', '$bodycam', '$prise', '$fin', '$pat', '$rapport', '$ipremote', '$date', '$confirmation')") or die(mysqli_error($con));

        //Embeds
        $authorname = "✈ Nouveaux Rapports ✈";
        $icon_url = "https://media.discordapp.net/attachments/739572685620641812/1005866802884124762/telechargement_1.jpeg";
        $title = "📢 Rapport de $prenom $nom";
        $color = 25500;
        $thumbnail_url = "https://media.discordapp.net/attachments/739572685620641812/1005866802884124762/telechargement_1.jpeg";
        $description = "Prénom: **$prenom** \n Nom: **$nom** \n Discord **$discord** \n Nombre d'arrestation **$arrest** \n Prise de services **$prise** \n Fin de Services **$fin** \n Patrouille **$pat** \n Rapport **$rapport** ";
        $footer_text = "crée par OnHamza2TV#8884";
        $footer_icon_url = "https://media.discordapp.net/attachments/739572685620641812/1005866802884124762/telechargement_1.jpeg";

        $message = [
            'content' => null,
            'avatar_url' => $avatar,
            'embeds' => [[
                'author' => [
                    'name' => $authorname,
                    'url' => $url,
                    'icon_url' => $icon_url,
                ],
                'title' => $title,
                'description' => $description,
                'color' => $color,
                'thumbnail' => [
                    'url' => $thumbnail_url,
                ],
                'image' => [
                    'url' => $image_url,
                ],
                'footer' => [
                    'text' => $footer_text,
                    'icon_url' => $footer_icon_url
                ]
            ]]
        ];

        $encoded_message = json_encode($message, JSON_PRETTY_PRINT);

        //var_dump($encoded_message);

        $webhook_url = WEBHOOK_DISCORD;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $webhook_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($encoded_message)
            )
        );

        curl_exec($ch);
        curl_close($ch);

        echo '<script>
                                                  $(document).ready(function () {
                                                      toastr["success"]("Votre Formulaire a bien etait envoye !",)
                                                  });
                                              </script><META http-equiv="refresh" content="2;URL=../success">';
    }
} ?>

<body>
    <div class="container">
        <img src="../assets/logofib.png" width="270">
        <div class="form-outer">
            <header>Système Logs</header>
            <div class="progress-bar">
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>1</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>2</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <div class="bullet">
                        <span>3</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>4</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>5</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>6</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
            </div>

            <form class="form" action="#" method="POST">
                <div class="page slide-page">
                    <div class="title">1️⃣ - Information RP:</div>
                    <div class="field">
                        <div class="label">Prénom:</div>
                        <input type="text" name="prenom" required placeholder="Exemple: Kalvine" />
                    </div>
                    <div class="field">
                        <div class="label">Nom:</div>
                        <input type="text" name="nom" required placeholder="Exemple: Kovalski" />
                    </div>
                    <div class="field">
                        <button class="firstNext next">Page suivante -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">2️⃣ - Information HRP:</div>
                    <div class="field">
                        <div class="label">Votre Discord:</div>
                        <input type="text" name="discord" required placeholder="Exemple: OnHamza2TV#8884" />
                    </div>
                    <div class="field">
                        <div class="label">Nombre d'arerestation:</div>
                        <input type="number" name="arrest" required placeholder="Exemple: 15 arrestation" />
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">
                            <- Revenir </button>
                                <button class="next-1 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">3️⃣ - Information RP:</div>
                    <div class="field">
                        <div class="label">Vous avez donne combien ?</div>
                        <input type="number" name="rons" required placeholder="Exemple: 100 000$ de ransom" />
                    </div>
                    <div class="field">
                        <div class="label">Lien de votre bodycam</div>
                        <input type="text" name="bodycam" required placeholder="Exemple: https://youtu.be/7zlA2i580s0" />
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">
                            <- Revenir </button>
                                <button class="next-2 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">4️⃣ - Information Service:</div>
                    <div class="field">
                        <div class="label">Heure de prise de service</div>
                        <input type="time" name="prise" required />
                    </div>
                    <div class="field">
                        <div class="label">Heure de fin de service</div>
                        <input type="time" name="fin" required />
                    </div>
                    <div class="field btns">
                        <button class="prev-3 prev">
                            <- Revenir </button>
                                <button class="next-3 next">Suivant -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">5️⃣ - Patrouille Patrouille</div>
                    <div class="field">
                        <div class="label" class="label">Vous avez patrouiller à combien ?</div>
                        <textarea type="textarea" rows="5" cols="33" disabled>Lincoln: Patrouille tout seul
Adam: Patrouille a 2 agent
Tango: Patrouille a 3 agent
FIA: Patrouille arrienne</textarea>
                    </div><br><br>
                    <div class="field">
                        <div class="label">Votre réponse</div>
                        <select required name="pat">
                            <option value="LINCOLN">Lincoln</option>
                            <option value="ADAM">Adam</option>
                            <option value="TANGO">Tango</option>
                            <option value="FIA">FIA</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-4 prev">
                            <- Revenir </button>
                                <button class="next-4 next">Suivant -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">6️⃣ - Information Rapport:</div>
                    <div class="field">
                        <div class="label" class="label">Votre Rapport:</div>
                        <textarea type="textarea" id="rapport" name="rapport" rows="5" cols="33" required placeholder="Exemple: Frank Pacino a grandi dans les quartiers mal famés de Blaine County. Vivant dans une famille nombreuses et ayant un fort caractères, il ce faisait souvent tabassez par ces frères et soeurs qui ne le supportaient pas. Son père étant un chomeur et sa mère femme de ménage, leur pat était vraiment précaire: c'est pourquoi Frank compris qu'il devait ce débrouillez lui même. Tandis que c'est frères ainés trainait avec différents cartel , il découvrit rapidement que sont fort caractère et c'est capacité de chimiste lui permetrait de ce faire une réputation dans les différents trafics illégales. Vers c'est 19 ans (après des années a cuisiner la meth aux cartels ), Frank comprit que le vrai commerce, celui qui rapportait gros, c'était de la vendre pour lui même . Frank décida se lancer dans l'aventure."></textarea>
                    </div><br><br>
                    <div class="field btns">
                        <button class="prev-5 prev">
                            <- Revenir </button>
                                <button class="submit" name="submit">Envoyé</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/script.js"></script>
</body>

</html>