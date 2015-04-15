    <header class="my_header">
    <script type="text/javascript">
		function date_heure(id)
		{
			date = new Date;
			annee = date.getFullYear();
			moi = date.getMonth();
			mois = new Array('Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre');
			j = date.getDate();
			jour = date.getDay();
			jours = new Array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
			h = date.getHours();
			if(h<10)
			{
				h = "0"+h;
			}
			m = date.getMinutes();
			if(m<10)
			{
				m = "0"+m;
			}
			s = date.getSeconds();
			if(s<10)
			{
				s = "0"+s;
			}
			resultat = ''+jours[jour]+' '+j+' '+mois[moi]+' '+annee+' il est '+h+':'+m+':'+s;
			document.getElementById(id).innerHTML = resultat;
			setTimeout('date_heure("'+id+'");','1000');
			return true;
		}
        </script>
        <div class="container">
            <div class="row">
                <div class="col-md-1"><img src="../ressources/img/logo.png" title="logo"></div> 
                <div class="col-md-1 col-md-offset-2">OXFAM</div>
                <div class="col-md-offset-5 col-md-2"> Bienvenue <br> <a href="../M_utilisateur/profile.php"><?php echo $user->getPrenom()." ".$user->getNom()?></a><br> <select><option name="francais">Francais</option> <option name="anglais">English</option></select>  </div>
                <div class=" col-md-1">  <a href="../M_utilisateur/deconnexion.php"><img src="../ressources/img/quitter.png"> </a></div>
            </div>
             <ul class="breadcrumbs col_6">
				<li>
					<a href="../accueil.php">Acceil</a>
				</li>
				<li>
					<a href="../accueil.php">Gestion Suivies</a>
				</li>
				<li>
					<a href="">Gestion operation</a>
				</li>
			</ul>
			<p class="col_6 fright txtalignright">
				<span id="date_heure"></span>
        		<script type="text/javascript">window.onload = date_heure('date_heure');</script>
			</p>
        </div>
    </header>