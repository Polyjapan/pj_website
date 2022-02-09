<?php include("settings.php") ?>

<footer id="home_footer">

  <div class="container">
    <div class="row">
      <div id="sns" class="col-md-4 mt-2">

        <div class="col-md-12">
          <h4><?php echo $translation["follow"][pll_current_language()] ?></h4>
        </div>
        <div class="links col-md-12 mt-3">


          <div class="">
            <a href="https://www.facebook.com/japanimpact.ch">
              <i class="fab fa-facebook-f"></i>
            </a>

          </div>
          <div class="">

            <a href="https://twitter.com/japanimpact">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
          <div class="">

            <a href="https://www.instagram.com/japan_impact/?hl=fr">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
          <div class="">
            <a href="https://www.youtube.com/user/JapanImpactOfficiel">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
          <!--div class="">
            <a href="https://www.addthis.com/bookmark.php?v=250">
              <i class="fas fa-plus"></i>
            </a>
          </div-->
          <!--div class="">
            <a href="https://japan-impact.ch/fr/contact/">
              <i class="fas fa-envelope"></i>
            </a>
          </div-->
        </div>


        <div class="col-md-12 mt-3">
          <p>
            Japan Impact <br>
            PolyJapan – AGEPoly <br>
            Esplanade EPFL (MEC 1398.1) <br>
			Station 9 <br>
            CH-1015 Lausanne
          </p>


        </div>
      </div>

      <div class="logos col-md-3 mb-2 mt-2" >

        <div class="col-sm-12">
          <h4><?php echo $translation["partners"][pll_current_language()] ?></h4>

        </div>

        <div class="col-sm-12">
          <a href="https://polyjapan.epfl.ch/">
            <img src="https://japan-impact.ch/wp-content/uploads/2021/10/pj_san-1.png" alt="polyjapan logo"/>
          </a>
          <a href="https://www.epfl.ch/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Logo_EPFL.svg/1280px-Logo_EPFL.svg.png" alt="epfl logo"/></a>
          <a href="https://agepoly.ch/"><img src="https://japan-impact.ch/wp-content/uploads/2021/10/logo_agepoly_new-1.png" alt="agepoly logo"/></a>
          <a href="http://www.tanigami.com/"><img src="https://i.imgur.com/upEPivC.png" alt=""> </a>
        </div>

      </div>
      <!--
      <div id="importantLinks"  class="col-sm-2">
      <ul>
      <li><a href="#">Présentation</a></li>
      <li><a href="#">Informations pratiques</a></li>
      <li><a href="#">Programme</a></li>
      <li><a href="#">FAQ</a></li>
      <li><a href="#">Partenaires</a></li>
    </ul>
  </div> -->

  <div id="address"  class="col-md-5 mb-2 mt-2">

    <div class="col-sm-12">
      <h4><?php echo $translation["location"][pll_current_language()] ?></h4>
    </div>

    <div class="col-sm-12">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2117.0023629014577!2d6.566656213981249!3d46.51974059231255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c30fe6ab1ee13%3A0x83081fc8c8e14b29!2sAvenue+Piccard+2%2C+1015+Ecublens!5e0!3m2!1sen!2sch!4v1545933880339" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
      <br>
      Ecole Polytechnique Fédérale de Lausanne (EPFL),
      Avenue Piccard 2, 1015 Ecublens, Suisse<br/>
    </div>

  </div>


</div>


</footer>


<div id="copyright">
  PolyJapan © 2021

</div>

<?php wp_footer() ?>

</body>
</html>
