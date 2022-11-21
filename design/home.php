<?php include "header.php"; ?>
<?php include "db.php";
session_start(); ?>
<?php
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
  $id = $_SESSION['user_id'];
  $query = mysqli_query($connection, "SELECT * FROM user WHERE user_id = $id");
  while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['user_id'];
    $email = $row['email'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $avatar = $row['avatar'];
?><br/><br/>
    <?php include "navbar1.php"; ?>
    <?php include "navbar2.php"; ?>
    <div class="container-lg d-none d-lg-block mb-4 mt-3">
      <div class="row row-cols-auto ps-2" id="search">
        <div class="p-1">
          <button class="six-txt" id="search1">
            Tree Plantation
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search1').remove();">
          </button>
        </div>
        <div class="p-1" id="search">
          <button class="six-txt">
            Canada
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search2').remove();">
          </button>
        </div>
        <div class="p-1" id="search3">
          <button class="six-txt">
            Toronto
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search3').remove();">
          </button>
        </div>
        <div class="p-1" id="search4">
          <button class="six-txt">
            Montreal
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search4').remove();">
          </button>
        </div>
        <div class="p-1" id="search5">
          <button class="six-txt">
            Environment
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search5').remove();">
          </button>
        </div>
        <div class="p-1" id="search6">
          <button class="six-txt">
            Nutrition
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search6').remove();">
          </button>
        </div>
        <div class="p-1" id="search7">
          <button class="six-txt">
            Anthropology
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search7').remove();">
          </button>
        </div>
        <div class="p-1" id="search8">
          <button class="six-txt">
            Environment Science
            <img src="../Assets/cancel.png" alt="" class="ps-1" height="8px" onclick="$('#search8').remove();">
          </button>
        </div>
        <div class="p-2">
          <button style="color:black; font-size:11px; border:none; background-color: white;" onclick="$('#search').remove();">Clear all</button>
        </div>
      </div>
    </div>
    <div class="container-lg mt-3">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-12">
          <h2 class="mb-0" style="font-size:calc(14px + 0.3vw);">Explore <b> 72 missions</b></h2>
        </div>
        <div class="col-lg-7 col-mb-7 col-sm-7 col-0" style="display:flex; justify-content:flex-end">
          <div class="d-none d-lg-block">
            <select class="Rounded-Rectangle-8">
              <option value="none" selected="" disabled="" hidden="">Sort by</option>
              <option value="newsest">Newest</option>
              <option value="oldest">Oldest</option>
              <option value="lowest">Lowest available seats</option>
              <option value="highest">Highest available seats</option>
              <option value="favourite">Sort by my favourite</option>
              <option value="deadline">sort by deadline</option>
            </select>
            <a href="#"><img src="../Assets/grid.png" alt="" class="Ellipse-574"></a>
            <a href="../design/homelist.html"><img src="../Assets/list.png" alt="" class="img-fluid mt-2" style="height:20px"></a>
          </div>
        </div>
      </div>
    </div>
    <main id="main">
      <section id="story">
        <div class="container-lg"><br>
          <div class="row row-eq-height justify-content-center">
            <?php
            $query = mysqli_query($connection, "SELECT *,mission.title as mission_title,mission_theme.title as theme_title,date(mission.start_date) as s_date,date(mission.end_date) as e_date,round(avg(rating)) as avg_rating FROM mission
            INNER JOIN mission_theme ON mission.theme_id=mission_theme.mission_theme_id 
            INNER JOIN mission_media ON mission.mission_id=mission_media.mission_id 
            INNER JOIN city ON mission.city_id=city.city_id 
            JOIN mission_rating ON mission.mission_id=mission_rating.mission_id
            LEFT JOIN goal_mission ON mission.mission_id=goal_mission.mission_id 
            GROUP BY mission_rating.mission_id
            ORDER BY mission.mission_id ASC");
            while ($row = mysqli_fetch_assoc($query)) {
              $mission_id = $row['mission_id'];
              $img = $row['media_path'];
              $city_name = $row['name'];
              $theme = $row['theme_title'];
              $title = $row['mission_title'];
              $description = $row['short_description'];
              $org_name = $row['organization_name'];
              $mission_type = $row['mission_type'];
              $start_date = $row['s_date'];
              $end_date = $row['e_date'];
              $rating = $row['avg_rating'];
              $goal = $row['goal_objective_text'];
            ?>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
                <div class="card box border-0">

                  <div class="gfg">
                    <img src="../<?php echo $img ?>" alt="" class="img-fluid" style="width:100%;">
                    <div class="d-flex align-items-center first-txt"><img src="../Assets/pin.png" alt="" class="img-fluid p-1 pt-0 pb-0" style="height:12px;"><span><?php echo $city_name; ?></span></div>
                    <div class="d-flex align-items-center second-txt2 p-2"><img src="../Assets/heart.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex align-items-center third-txt p-2"><img src="../Assets/user.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex four-txt justify-content-center">
                      <div class="bdg1"><?php echo $theme; ?></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="color:black">
                      <div class="card-body remove">
                        <a href="" style="color:black">
                          <h2 class="card-title mb-1" style="font-size:calc(15px + 0.3vw);"><?php echo $title; ?></h2>
                        </a>
                        <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);"><?php echo $description; ?></p>
                        <div class="d-flex justify-content-between">
                          <div>
                            <h6 class="m-0" style="font-size:calc(11px + 0.1vw);"><?php echo $org_name; ?></h6>
                          </div>
                          <div class="icon">
                            <?php
                            //$query = mysqli_query($connection, "SELECT ROUND(AVG(rating)) as rating FROM mission_rating WHERE mission_id = $mission_id");
                            //while ($row = mysqli_fetch_assoc($query)) {
                              //$rating = $row['rating'];
                            for ($x = 0; $x < 5; $x++) {
                              if ($x < $rating) {
                                echo "<img src='../Assets/selected-star.png' alt='' class='pl-1 star'>";
                              } else {
                                echo "<img src='../Assets/star.png' alt='' class='pl-1 star'>";
                              }
                            //}
                           } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    if ($mission_type != '') {
                      echo "<div class='d-flex align-items-center'>";
                      echo "<hr class='flex-grow-1 div m-0'>";
                      if ($mission_type == 'TIME') {
                        if ($start_date != null && $end_date != null) {
                          $start_date = date("d-m-Y", strtotime($start_date));
                          $end_date = date("d-m-Y", strtotime($end_date));
                          echo "<div class='bdg'>From $start_date until $end_date</div>";
                        }
                        else {
                          echo "<div class='bdg'>Ongoing Opportunity</div>";
                        }
                      } else {
                        echo "<div class='bdg'>$goal</div>";
                      }
                      echo "<hr class='flex-grow-1 div m-0'>";
                      echo "</div>";
                    ?>
                      <div class="card-body m-2 mt-0 mb-0 pt-2 pb-2 padremove">
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                            <div class="row">
                              <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../Assets/Seats-left.png" alt="" style="height:23px"></div>
                              <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">10</h4>
                                <h6 class="mb-2" style="font-size:12px ;color:gray;">Seats Left</h6>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                            <div class="row">
                              <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../Assets/deadline.png" alt="" style="height:28px"></div>
                              <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">09/01/2019</h4>
                                <h6 class="mb-2" style="font-size:12px ;color:gray;">Deadline</h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <hr class="div">
                  <a href="" style="text-decoration:none;">
                    <div class="d-flex align-items-center justify-content-center">
                      <button class="col-example mt-3" style="font-size:calc(13px + 0.1vw);">Apply<i class="fa fa-arrow-right ps-3" aria-hidden="true"></i>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
              <div class="card box border-0"><a href="#" style="text-decoration:none;">
                  <div class="gfg"><img src="../Assets/CSR-initiative-stands-for-Coffee--and-Farmer-Equity.png" alt="" class="img-fluid" style="width:100%;">
                    <div class="d-flex align-items-center first-txt"><img src="../Assets/pin.png" alt="" class="img-fluid p-1 pt-0 pb-0" style="height:12px;"><span>London</span></div>
                    <div class="d-flex align-items-center second-txt2 p-2"><img src="../Assets/heart.png" alt="" class="img-fluid" style="height:15px; width: 18px;"></div>
                    <div class="d-flex align-items-center third-txt p-2"><img src="../Assets/user.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex four-txt justify-content-center">
                      <div class="bdg1">Environment</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="color:black">
                      <div class="card-body remove">
                        <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);">CSR initiative stands
                          for Coffee
                          and Farmer Equity</h2>
                        <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);">Lorem ipsum dolor sit amet,
                          consectetur
                          adipiscing elit, sed do eiusmod tempor incididunt ut labore...</p>
                        <div class="d-flex justify-content-between">
                          <div>
                            <h6 class="m-0" style="font-size:calc(11px + 0.1vw);">CSE Network</h6>
                          </div>
                          <div class="icon"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"></div>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div m-0">
                        <div class="bdg">Ongoing Opportunity</div>
                        <hr class="flex-grow-1 div m-0">
                      </div>
                    </div>
                    <div class="card-body m-2 mt-0 mb-0 pt-2 pb-2 padremove">
                      <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 col-7" style="color:black;">
                          <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../Assets/Already-volunteered.png" alt="" style="height:20px">
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                              <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">250</h4>
                              <h6 class="mb-2" style="font-size:12px ;color:gray;">Already volunteered</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="div">
                  <div class="d-flex align-items-center justify-content-center">
                    <div class=" col-example mt-3 mt-3" style="font-size:calc(13px + 0.1vw);">Apply<img src="../Assets/right-arrow.png" alt="" class="ps-3"></div>
                  </div>
                </a></div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
              <div class="card box border-0"><a href="#" style="text-decoration:none;">
                  <div class="gfg"><img src="../Assets/Animal-welfare-&amp;-save-birds-campaign.png" alt="" class="img-fluid" style="width:100%;">
                    <div class="d-flex align-items-center first-txt"><img src="../Assets/pin.png" alt="" class="img-fluid p-1 pt-0 pb-0" style="height:12px;"><span>Cape Town</span></div>
                    <div class="d-flex align-items-center second-txt2 p-2"><img src="../Assets/heart.png" alt="" class="img-fluid" style="height:15px; width: 18px;"></div>
                    <div class="d-flex align-items-center third-txt p-2"><img src="../Assets/user.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex four-txt justify-content-center">
                      <div class="bdg1">Animals</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="color:black">
                      <div class="card-body remove">
                        <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);">Animal welfare &amp;
                          save birds
                          campaign</h2>
                        <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);">Lorem ipsum dolor sit amet,
                          consectetur
                          adipiscing elit, sed do eiusmod tempor incididunt ut labore...</p>
                        <div class="d-flex justify-content-between">
                          <div>
                            <h6 class="m-0" style="font-size:calc(11px + 0.1vw);">JR Foundation</h6>
                          </div>
                          <div class="icon"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star">
                          </div>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div m-0">
                        <div class="bdg">Plant 10,000 Trees</div>
                        <hr class="flex-grow-1 div m-0">
                      </div>
                    </div>
                    <div class="card-body m-2 mt-0 mb-0 pt-2 pb-2 padremove">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                          <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../Assets/Seats-left.png" alt="" style="height:23px"></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                              <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">10</h4>
                              <h6 class="mb-2" style="font-size:12px ;color:gray;">Seats Left</h6>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                          <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../Assets/achieved.png" alt="" style="height:22px"></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                              <div class="mt-1 mb-3" style="background-color:#EEEEEE; height:7px; width:100%; border-radius: 10px;">
                                <div style="background-color:#f88634; height:7px; border-radius: 10px; width:80%;">
                                </div>
                              </div>
                              <h6 class="mb-2" style="font-size:12px ;color:gray;">8000 achieved</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="div">
                  <div class="d-flex align-items-center justify-content-center">
                    <div class=" col-example mt-3 mt-3" style="font-size:calc(13px + 0.1vw);">Apply<img src="../Assets/right-arrow.png" alt="" class="ps-3"></div>
                  </div>
                </a></div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
              <div class="card box border-0"><a href="#" style="text-decoration:none;">
                  <div class="gfg"><img src="../Assets/Plantation-and-Afforestation-programme.png" alt="" class="img-fluid" style="width:100%;">
                    <div class="d-flex align-items-center first-txt"><img src="../Assets/pin.png" alt="" class="img-fluid p-1 pt-0 pb-0" style="height:12px;"><span>Paris</span></div>
                    <div class="d-flex align-items-center second-txt2 p-2"><img src="../Assets/heart.png" alt="" class="img-fluid" style="height:15px; width: 18px;"></div>
                    <div class="d-flex align-items-center third-txt p-2"><img src="../Assets/user.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex four-txt justify-content-center">
                      <div class="bdg1">Health</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="color:black">
                      <div class="card-body remove">
                        <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);">Plantation and
                          Afforestation
                          programme</h2>
                        <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);">Lorem ipsum dolor sit amet,
                          consectetur
                          adipiscing elit, sed do eiusmod tempor incididunt ut labore...</p>
                        <div class="d-flex justify-content-between">
                          <div>
                            <h6 class="m-0" style="font-size:calc(11px + 0.1vw);">Amaze Doctors</h6>
                          </div>
                          <div class="icon"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star"><img src="../Assets/star.png" alt="" class="ps-1 star">
                          </div>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div m-0">
                        <div class="bdg">Plant 10,000 Trees</div>
                        <hr class="flex-grow-1 div m-0">
                      </div>
                    </div>
                    <div class="card-body m-2 mt-0 mb-0 pt-2 pb-2 padremove">
                      <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 col-7" style="color:black;">
                          <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../Assets/achieved.png" alt="" style="height:22px"></div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                              <div class="mt-1 mb-3" style="background-color:#EEEEEE; height:7px; width:100%; border-radius: 10px;">
                                <div style="background-color:#f88634; height:7px; border-radius: 10px; width:80%;">
                                </div>
                              </div>
                              <h6 class="mb-2" style="font-size:12px ;color:gray;">8000 achieved</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="div">
                  <div class="d-flex align-items-center justify-content-center">
                    <div class=" col-example mt-3 mt-3" style="font-size:calc(13px + 0.1vw);">Apply<img src="../Assets/right-arrow.png" alt="" class="ps-3"></div>
                  </div>
                </a></div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
              <div class="card box border-0"><a href="#" style="text-decoration:none;">
                  <div class="gfg"><img src="../Assets/Grow-Trees-On-the-path-to-environment-sustainability.png" alt="" class="img-fluid" style="width:100%;">
                    <div class="d-flex align-items-center first-txt"><img src="../Assets/pin.png" alt="" class="img-fluid p-1 pt-0 pb-0" style="height:12px;"><span>New York</span></div>
                    <div class="d-flex align-items-center second-txt2 p-2"><img src="../Assets/heart.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex align-items-center third-txt p-2"><img src="../Assets/user.png" alt="" class="img-fluid" style="height:17px"></div>
                    <div class="d-flex four-txt justify-content-center">
                      <div class="bdg1">Education</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="color:black">
                      <div class="card-body remove">
                        <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);">Grow Trees – On the path to
                          environment sustainability</h2>
                        <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);">Lorem ipsum dolor sit amet,
                          consectetur
                          adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                          minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                          Duis aute irure dolor in reprehenderit...</p>
                        <div class="d-flex justify-content-between">
                          <div>
                            <h6 class="m-0" style="font-size:calc(11px + 0.1vw);">Tree Canada</h6>
                          </div>
                          <div class="icon"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"><img src="../Assets/selected-star.png" alt="" class="ps-1 star"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="div">
                  <div class="d-flex align-items-center justify-content-center">
                    <div class=" col-example mt-3" style="font-size:calc(13px + 0.1vw);">View Detail<img src="../Assets/right-arrow.png" alt="" class="ps-3"></div>
                  </div>
                </a></div>
            </div>
          </div>
          <nav aria-label="Page navigation example">
            <ul class="pagination pager justify-content-center">
              <li class="page-item">
                <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
              </li>
              <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
              <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
              </li>
              <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
              </li>
              <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
              </li>
              <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
            </ul>
          </nav><br />
        </div>
      </section>
    </main>
    <?php include "footer.php"; ?>
<?php
  }
} else {
  header('Location:../ci-platform/login.php');
}
?>
</body>

</html>