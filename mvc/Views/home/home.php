<main id="main">
  <section id="story">
    <div class="container-lg"><br>
      <div id="divgrid">
        <div class="row row-eq-height justify-content-center">
          <?php foreach ($missions as $mission) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
              <div class="card box border-0">
                <div class="gfg">
                  <img src="../<?php echo $mission->media_path; ?>" alt="" class="img-fluid" style="width:100%;">
                  <div class="d-flex align-items-center first-txt"><img src="../mvc/Assets/images/pin.png" alt="" class="img-fluid pe-1" style="height:12px;"><?php echo $mission->city_name; ?></div>
                  <?php if ($mission->mission_type == 'TIME') {
                    $current = date("Y-m-d h:i:s");
                    if ($mission->deadline != null) {
                      if ($current > $mission->deadline) {
                        echo '<div class="d-flex align-items-center five-txt" style="background-color:red;">CLOSED</div>';
                      }
                    } else if ($mission->end_date != null) {
                      if ($current > $mission->end_date) {
                        echo '<div class="d-flex align-items-center five-txt" style="background-color:red;">CLOSED</div>';
                      }
                    }
                  }
                  ?>
                  <?php
                  $key = 0;
                  foreach ($appusers as $appuser) {
                    if ($appuser->mission_id == $mission->missionid) {
                      $key = 1;
                      break;
                    }
                  }
                  if ($key == 1) {
                    echo '<div class="d-flex align-items-center five-txt">APPLIED</div>';
                  }
                  ?>
                  <div class="d-flex align-items-center second-txt2 p-2">
                    <?php
                    $key = 0;
                    foreach ($likeusers as $likeuser) {
                      if ($likeuser->mission_id == $mission->missionid) {
                        $key = 1;
                        break;
                      }
                    }
                    if ($key == 1) {
                      echo "<a href='home?source=unlike_mission&like=$mission->missionid&user=$user_id'><i class='fa fa-heart text-danger' aria-hidden='true'></i></a>";
                    } else {
                      echo "<a href='home?source=like_mission&like=$mission->missionid&user=$user_id'><i class='fa fa-heart-o' aria-hidden='true' style='color:white'></i></a>";
                    }
                    ?>
                  </div>
                  <div class="d-flex align-items-center third-txt p-2"><a href="" style="color: black;" data-bs-toggle="modal" data-bs-target="#popup<?php echo $mission->missionid ?>"><img src="../mvc/Assets/images/user.png" alt="" class="img-fluid" style="height:17px"></a></div>
                  <div id="popup<?php echo $mission->missionid ?>" class="modal">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content p-2">
                        <div class="modal-header pb-0" style="border-bottom:0 ;">
                          <p class="mb-0" style="font-size:20px ;">Invite</p>
                        </div>
                        <form class="m-0" method="post" enctype="multipart/form-data">
                          <input type="text" name='m_id' value="<?php echo $mission->missionid ?>" hidden>
                          <div class="modal-body pb-0">

                            <p class="mb-1 mt-3">Email </p>
                            <input type="email" class="popup" name="email" place-holder='enter user email to invite'>
                          </div>
                          <div class="modal-footer mt-4" style="border-top:0 ;">
                            <button type="reset" class="col-example8" data-bs-dismiss="modal">Cancle
                            </button>
                            <button type="submit" name='inviteuser' class="col-example7" data-bs-dismiss="modal">Invite
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex four-txt justify-content-center">
                    <div class="bdg1"><?php echo $mission->theme_title; ?></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="color:black">
                    <div class="card-body pb-3 remove">
                      <a href="Volunteering_Mission?id=<?php $id = $mission->mission_id;
                                                        $salt = "SECRET_STUFF";
                                                        $encrypted_id = base64_encode($id . $salt);
                                                        echo $encrypted_id; ?>" style="color:black;">
                        <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);"><?php echo $mission->mission_title; ?></h2>
                      </a>
                      <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);">
                        <?php
                        $key = 0;
                        foreach ($appusers as $appuser) {
                          if ($appuser->mission_id == $mission->missionid) {
                            $key = 1;
                            break;
                          }
                        }
                        if ($mission->mission_type == 'TIME') {
                          $current = date("Y-m-d h:i:s");
                          if ($mission->deadline != null && $current > $mission->deadline) {
                            $key = 1;
                          } else if ($mission->end_date != null && $current > $mission->end_date) {
                            $key = 1;
                          }
                        }
                        $k = 0;
                        $c = 10;
                        foreach ($seats as $seat) {
                          if ($seat->mission_id == $mission->missionid) {
                            $k = 1;
                            break;
                          }
                        }
                        if ($k == 1) {
                          $c = $mission->total_seat - $seat->count;
                        }
                        if ($key == 1 || $c == 0) {
                          echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...';
                        } else {
                          echo $mission->short_description;
                        }
                        ?>
                      </p>
                      <div class="d-flex justify-content-between">
                        <div>
                          <h6 class="m-0" style="font-size:calc(11px + 0.1vw);"><?php echo $mission->organization_name; ?></h6>
                        </div>
                        <div class="icon">
                          <?php for ($x = 0; $x < 5; $x++) {
                            if ($x < $mission->rating) {
                              echo "<img src='../mvc/Assets/images/selected-star.png' alt='' class='ps-1 star'>";
                            } else {
                              echo "<img src='../mvc/Assets/images/star.png' alt='' class='ps-1 star'>";
                            }
                          } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  $key = 0;
                  foreach ($appusers as $appuser) {
                    if ($appuser->mission_id == $mission->missionid) {
                      $key = 1;
                      break;
                    }
                  }
                  if ($mission->mission_type == 'TIME') {
                    $current = date("Y-m-d h:i:s");
                    if ($mission->deadline != null && $current > $mission->deadline) {
                      $key = 1;
                    } else if ($mission->end_date != null && $current > $mission->end_date) {
                      $key = 1;
                    }
                  }
                  $k = 0;
                  $c = 10;
                  foreach ($seats as $seat) {
                    if ($seat->mission_id == $mission->missionid) {
                      $k = 1;
                      break;
                    }
                  }
                  if ($k == 1) {
                    $c = $mission->total_seat - $seat->count;
                    if ($c == 0) {
                      $key = 1;
                    }
                  }
                  if ($key == 0) { ?>
                    <?php if ($mission->mission_type == 'TIME') { ?>
                      <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div m-0">
                        <div class="bdg">
                          <?php
                          if ($mission->start_date != null && $mission->end_date != null) {
                            $start_date = date("d-m-Y", strtotime($mission->start_date));
                            $end_date = date("d-m-Y", strtotime($mission->end_date));
                            echo "From $start_date until $end_date";
                          } else {
                            echo "Ongoing Opportunity";
                          }
                          ?>
                        </div>
                        <hr class="flex-grow-1 div m-0">
                      </div>
                    <?php } else { ?>
                      <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div m-0">
                        <div class="bdg"><?php echo $mission->goal_objective_text; ?>
                        </div>
                        <hr class="flex-grow-1 div m-0">
                      </div>
                    <?php } ?>
                    <div class="card-body pt-2 pb-2 padremove">
                      <div class="row">
                        <?php
                        if ($mission->mission_type == 'TIME') {
                          if ($mission->total_seat != null) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                              <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/Seats-left.png" alt="" style="height:23px"></div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                  <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                    <?php
                                    $key = 0;
                                    foreach ($seats as $seat) {
                                      if ($seat->mission_id == $mission->missionid) {
                                        $key = 1;
                                        break;
                                      }
                                    }
                                    if ($key == 1) {
                                      echo $mission->total_seat - $seat->count;
                                    } else {
                                      echo $mission->total_seat;
                                    }
                                    ?>
                                  </h4>
                                  <h6 class="mb-2" style="font-size:12px ;color:gray;">Seats Left</h6>
                                </div>
                              </div>
                            </div>
                          <?php } else { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                              <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/Already-volunteered.png" alt="" style="height:20px"></div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                  <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                    <?php
                                    $key = 0;
                                    foreach ($seats as $seat) {
                                      if ($seat->mission_id == $mission->missionid) {
                                        $key = 1;
                                        break;
                                      }
                                    }
                                    if ($key == 1) {
                                      echo $seat->count;
                                    } else {
                                      echo '0';
                                    }
                                    ?>
                                  </h4>
                                  <h6 class="mb-2" style="font-size:11px ;color:gray;">Already volunteered</h6>
                                </div>
                              </div>
                            </div>
                          <?php }
                          if ($mission->deadline != null) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                              <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/deadline.png" alt="" style="height:28px"></div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                  <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                    <?php
                                    $deadline = date("d/m/Y", strtotime($mission->deadline));
                                    echo "$deadline";
                                    ?>
                                  </h4>
                                  <h6 class="mb-2" style="font-size:12px ;color:gray;">Deadline</h6>
                                </div>
                              </div>
                            </div>
                          <?php }
                        } else { ?>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                            <div class="row">
                              <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/achieved.png" alt="" style="height:22px"></div>
                              <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                <div class="mt-1 mb-3" style="background-color:#EEEEEE; height:7px; width:100%; border-radius: 10px;">
                                  <div style="background-color:#f88634; height:7px; border-radius: 10px; width:80%;">
                                  </div>
                                </div>
                                <h6 class="mb-2" style="font-size:12px ;color:gray;">8000 achieved</h6>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  <?php }  ?>
                </div>
                <hr class="div">
                <div class="d-flex align-items-center justify-content-center">
                  <button class=" col-example mt-3" style="font-size:calc(13px + 0.1vw);">
                    <?php
                    $key = 0;
                    foreach ($appusers as $appuser) {
                      if ($appuser->mission_id == $mission->missionid) {
                        $key = 1;
                        break;
                      }
                    }
                    if ($mission->mission_type == 'TIME') {
                      $current = date("Y-m-d h:i:s");
                      if ($mission->deadline != null && $current > $mission->deadline) {
                        $key = 1;
                      } else if ($mission->end_date != null && $current > $mission->end_date) {
                        $key = 1;
                      }
                    }
                    $k = 0;
                    $c = 10;
                    foreach ($seats as $seat) {
                      if ($seat->mission_id == $mission->missionid) {
                        $k = 1;
                        break;
                      }
                    }
                    if ($k == 1) {
                      $c = $mission->total_seat - $seat->count;
                    }
                    if ($key == 1 || $c == 0) { ?>
                      <a href="Volunteering_Mission?id=<?php $id = $mission->mission_id;
                                                        $salt = "SECRET_STUFF";
                                                        $encrypted_id = base64_encode($id . $salt);
                                                        echo $encrypted_id; ?>" style="color: inherit;">View Detail</a>
                    <?php } else { ?>
                      <a href="home?source=apply&id=<?php echo $mission->missionid ?>" style="color: inherit;">Apply</a>
                    <?php }
                    ?>
                    <i class="fa fa-arrow-right ps-2"></i>
                  </button>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div id="divlist" style="display:none">
        <div class="row row-eq-height justify-content-center">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
            <?php foreach ($missions as $mission) { ?>
              <div class="card box border-0 mb-4">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-3 position-relative">
                    <img src="../<?php echo $mission->media_path; ?>" alt="" class="img-fluid" style="height:100%">
                    <div class="d-flex align-items-center first-txt1">
                      <img src="../mvc/Assets/images/pin.png" alt="" class="img-fluid pe-2" style="height:10px;">
                      <span><?php echo $mission->city_name; ?></span>
                    </div>
                    <?php if ($mission->mission_type == 'TIME') {
                      $current = date("Y-m-d h:i:s");
                      if ($mission->deadline != null) {
                        if ($current > $mission->deadline) {
                          echo '<div class="d-flex align-items-center five-txt" style="background-color:red;">CLOSED</div>';
                        }
                      } else if ($mission->end_date != null) {
                        if ($current > $mission->end_date) {
                          echo '<div class="d-flex align-items-center five-txt" style="background-color:red;">CLOSED</div>';
                        }
                      }
                    }
                    ?>
                    <?php
                    $key = 0;
                    foreach ($appusers as $appuser) {
                      if ($appuser->mission_id == $mission->missionid) {
                        $key = 1;
                        break;
                      }
                    }
                    if ($key == 1) {
                      echo '<div class="d-flex align-items-center five-txt">APPLIED</div>';
                    }
                    ?>
                    <div class="d-flex align-items-center second-txt1 p-2">
                      <?php
                      $key = 0;
                      foreach ($likeusers as $likeuser) {
                        if ($likeuser->mission_id == $mission->missionid) {
                          $key = 1;
                          break;
                        }
                      }
                      if ($key == 1) {
                        echo "<a href='home?source=unlike_mission&like=$mission->missionid&user=$user_id'><i class='fa fa-heart text-danger' aria-hidden='true'></i></a>";
                      } else {
                        echo "<a href='home?source=like_mission&like=$mission->missionid&user=$user_id'><i class='fa fa-heart-o' aria-hidden='true' style='color:white'></i></a>";
                      }
                      ?>
                    </div>
                    <div class="d-flex align-items-center third-txt1 p-2">
                      <img src="../mvc/Assets/images/user.png" alt="" class="img-fluid" style="height:17px">
                    </div>
                    <div class="d-flex four-txt justify-content-center">
                      <div class="bdg1"><?php echo $mission->theme_title; ?></div>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                    <div class="card-body me-4">
                      <div class="d-flex justify-content-between">
                        <div>
                          <img src="../mvc/Assets/images/pin1.png" alt="" class="img-fluid pe-3" style="height:13px;">
                          <span class="black"><?php echo $mission->city_name; ?></span> <img src="../mvc/Assets/images/web.png" alt="" class="img-fluid pe-3 ps-3" style="height:13px;">
                          <span class="black"><?php echo $mission->theme_title; ?></span> <img src="../mvc/Assets/images/organization.png" alt="" class="img-fluid pe-3 ps-3" style="height:13px;">
                          <span class="black"><?php echo $mission->organization_name; ?></span>
                        </div>
                        <div class="icon">
                          <?php for ($x = 0; $x < 5; $x++) {
                            if ($x < $mission->rating) {
                              echo "<img src='../mvc/Assets/images/selected-star.png' alt='' class='ps-1 star'>";
                            } else {
                              echo "<img src='../mvc/Assets/images/star.png' alt='' class='ps-1 star'>";
                            }
                          } ?>
                        </div>
                      </div>
                      <h2 class="card-title mt-2" style="font-size:calc(15px + 0.3vw); color:black;">
                        <a href="" style="color: black;">
                          <?php echo $mission->mission_title; ?>
                        </a>
                      </h2>
                      <p class="mb-3" style="color:gray; font-size:calc(11px + 0.1vw);">
                        <?php
                        $key = 0;
                        foreach ($appusers as $appuser) {
                          if ($appuser->mission_id == $mission->missionid) {
                            $key = 1;
                            break;
                          }
                        }
                        if ($mission->mission_type == 'TIME') {
                          $current = date("Y-m-d h:i:s");
                          if ($mission->deadline != null && $current > $mission->deadline) {
                            $key = 1;
                          } else if ($mission->end_date != null && $current > $mission->end_date) {
                            $key = 1;
                          }
                        }
                        $k = 0;
                        $c = 10;
                        foreach ($seats as $seat) {
                          if ($seat->mission_id == $mission->missionid) {
                            $k = 1;
                            break;
                          }
                        }
                        if ($k == 1) {
                          $c = $mission->total_seat - $seat->count;
                        }
                        if ($key == 1 || $c == 0) {
                          echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...';
                        } else {
                          echo $mission->short_description;
                        }
                        ?>
                      </p>
                      <div class="d-flex justify-content-between">
                        <div>
                          <div class="row">
                            <?php
                            $key = 0;
                            foreach ($appusers as $appuser) {
                              if ($appuser->mission_id == $mission->missionid) {
                                $key = 1;
                                break;
                              }
                            }
                            if ($mission->mission_type == 'TIME') {
                              $current = date("Y-m-d h:i:s");
                              if ($mission->deadline != null && $current > $mission->deadline) {
                                $key = 1;
                              } else if ($mission->end_date != null && $current > $mission->end_date) {
                                $key = 1;
                              }
                            }
                            $k = 0;
                            $c = 10;
                            foreach ($seats as $seat) {
                              if ($seat->mission_id == $mission->missionid) {
                                $k = 1;
                                break;
                              }
                            }
                            if ($k == 1) {
                              $c = $mission->total_seat - $seat->count;
                              if ($c == 0) {
                                $key = 1;
                              }
                            }
                            if ($key == 0) { ?>
                              <?php if ($mission->mission_type == 'TIME') {
                                if ($mission->total_seat != null) { ?>
                                  <div class="col" style="color:black;">
                                    <div class="row">
                                      <div class="col-lg-1 col-md-1 col-sm-1 col-1"><img src="../mvc/Assets/images/Seats-left.png" alt="" style="height:21px"></div>
                                      <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                        <h4 class="mb-1" style="font-size:calc(12px + 0.1vw);">
                                          <?php
                                          $key = 0;
                                          foreach ($seats as $seat) {
                                            if ($seat->mission_id == $mission->missionid) {
                                              $key = 1;
                                              break;
                                            }
                                          }
                                          if ($key == 1) {
                                            echo $mission->total_seat - $seat->count;
                                          } else {
                                            echo $mission->total_seat;
                                          }
                                          ?>
                                        </h4>
                                        <h6 class="mb-0" style="font-size:12px ;color:gray;">Seats Left</h6>
                                      </div>
                                    </div>
                                  </div>
                                <?php } else { ?>
                                  <div class="col" style="color:black;">
                                    <div class="row">
                                      <div class="col-lg-1 col-md-1 col-sm-1 col-1"><img src="../mvc/Assets/images/Seats-left.png" alt="" style="height:21px"></div>
                                      <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                        <h4 class="mb-1" style="font-size:calc(12px + 0.1vw);">
                                          <?php
                                          $key = 0;
                                          foreach ($seats as $seat) {
                                            if ($seat->mission_id == $mission->missionid) {
                                              $key = 1;
                                              break;
                                            }
                                          }
                                          if ($key == 1) {
                                            echo $seat->count;
                                          } else {
                                            echo '0';
                                          }
                                          ?>
                                        </h4>
                                        <h6 class="mb-0" style="font-size:11px ;color:gray;">Already volunteered</h6>
                                      </div>
                                    </div>
                                  </div>
                                <?php }
                                if ($mission->deadline != null) { ?>
                                  <div class="col" style="color:black;">
                                    <div class="row">
                                      <div class="col-lg-1 col-md-1 col-sm-1 col-1"><img src="../mvc/Assets/images/deadline.png" alt="" style="height:28px"></div>
                                      <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                        <h4 class="mb-1" style="font-size:calc(12px + 0.1vw);">
                                          <?php
                                          $deadline = date("d/m/Y", strtotime($mission->deadline));
                                          echo "$deadline";
                                          ?>
                                        </h4>
                                        <h6 class="mb-0" style="font-size:12px ;color:gray;">Deadline</h6>
                                      </div>
                                    </div>
                                  </div>
                                <?php } ?>
                                <div class="col" style="color:black;">
                                  <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1"><img src="../mvc/Assets/images/calender.png" alt="" style="height:20px"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                      <h4 class="mb-1" style="font-size:11px;">
                                        <?php
                                        if ($mission->start_date != null && $mission->end_date != null) {
                                          $start_date = date("d-m-Y", strtotime($mission->start_date));
                                          $end_date = date("d-m-Y", strtotime($mission->end_date));
                                          echo "From $start_date until $end_date";
                                        } else {
                                          echo "Ongoing Opportunity";
                                        }
                                        ?>
                                      </h4>
                                    </div>
                                  </div>
                                </div>
                              <?php } else { ?>
                                <div class="col" style="color:black;">
                                  <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1"><img src="../mvc/Assets/images/achieved.png" alt="" style="height:22px"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                      <div class="mt-2 mb-2" id="forwidth" style="background-color:#EEEEEE; height:7px; width:100%; border-radius: 10px;">
                                        <div style="background-color:#f88634; height:7px; border-radius: 10px; width:80%;" class="6"></div>
                                      </div>
                                      <h6 class="mb-0" style="font-size:12px ;color:gray;">8000 achieved</h6>
                                    </div>
                                  </div>
                                </div>
                                <div class="col" style="color:black;">
                                  <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1"><img src="../mvc/Assets/images/calender.png" alt="" style="height:20px"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                      <h4 class="mb-1" style="font-size:11px;">
                                        <?php echo $mission->goal_objective_text; ?>
                                      </h4>
                                    </div>
                                  </div>
                                </div>
                              <?php } ?>
                              <div class="col" style="color:black;">
                                <div class="row">
                                  <div class="col-lg-1 col-md-1 col-sm-1 col-1"><i class="fa fa-cogs" aria-hidden="true" style="color: gray;"></i></div>
                                  <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                    <h4 class="mb-1" style="font-size:calc(12px + 0.1vw);">Skills</h4>
                                    <h6 class="mb-0" style="font-size:12px ;color:gray;"><?php echo $mission->skill_name; ?></h6>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div>
                          <button class="col-example1" style="font-size:calc(12px + 0.1vw);">
                            <?php
                            $key = 0;
                            foreach ($appusers as $appuser) {
                              if ($appuser->mission_id == $mission->missionid) {
                                $key = 1;
                                break;
                              }
                            }
                            if ($mission->mission_type == 'TIME') {
                              $current = date("Y-m-d h:i:s");
                              if ($mission->deadline != null && $current > $mission->deadline) {
                                $key = 1;
                              } else if ($mission->end_date != null && $current > $mission->end_date) {
                                $key = 1;
                              }
                            }
                            $k = 0;
                            $c = 10;
                            foreach ($seats as $seat) {
                              if ($seat->mission_id == $mission->missionid) {
                                $k = 1;
                                break;
                              }
                            }
                            if ($k == 1) {
                              $c = $mission->total_seat - $seat->count;
                            }
                            if ($key == 1 || $c == 0) { ?>
                              <a href="Volunteering_Mission?id=<?php $id = $mission->mission_id;
                                                                $salt = "SECRET_STUFF";
                                                                $encrypted_id = base64_encode($id . $salt);
                                                                echo $encrypted_id; ?>" style="color: inherit;">View Detail</a>
                            <?php } else { ?>
                              <a href="Volunteering_Mission?id=<?php $id = $mission->mission_id;
                                                                $salt = "SECRET_STUFF";
                                                                $encrypted_id = base64_encode($id . $salt);
                                                                echo $encrypted_id; ?>" style="color: inherit;">Apply</a>
                            <?php }
                            ?>
                            <i class="fa fa-arrow-right"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if ($row > 0) { ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination pager justify-content-center">
            <?php
            $next = $page + 1;
            $previous = $page - 1;
            if ($page == 1) {
              echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/previous.png' alt=''></a></li>";
              echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/left.png' alt=''></a></li>";
            } else {
              echo "<li class='page-item'><a class='page-link' href='home?page=1' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/previous.png' alt=''></a></li>";
              echo "<li class='page-item'><a class='page-link' href='home?page=$previous' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/left.png' alt=''></a></li>";
            }
            for ($i = 1; $i <= $cnt; $i++) {
              if ($i == $page)
                echo "<li class='page-item'><a class='page-link active text-center' href='home?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;'><b>$i</b></a></li>";
              else
                echo "<li class='page-item'><a class='page-link text-center' href='home?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;'>$i</a></li>";
            }
            if ($page == $cnt) {
              echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/arrow.png' alt=''></a></li>";
              echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/next.png' alt=''></a></li>";
            } else {
              echo "<li class='page-item'><a class='page-link' href='home?page=$next' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/arrow.png' alt=''></a></li>";
              echo "<li class='page-item'><a class='page-link' href='home?page=$cnt' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='../mvc/Assets/images/next.png' alt=''></a></li>";
            }
            ?>
          </ul>
        </nav>
      <?php } else { ?>
        <div class="text-center">mission not found</div>
      <?php } ?>
      <br />
    </div>
  </section>
</main>