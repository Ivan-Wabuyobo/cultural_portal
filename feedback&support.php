<!DOCTYPE html>
<html lang="en">
<?php
include_once 'home_sidebar.php'
?>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Culture tutor</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets1/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets1/css/style.css">
  <link rel="stylesheet" href="assets1/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets1/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets1/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card">
                  <div class="body">
                    <div id="mail-nav">
                      <button type="button" class="btn btn-danger waves-effect btn-compose m-b-15">Feedback</button>
                      <ul class="" id="mail-folders">
                        <li>
                          <a href="feeds.php" title="Inbox">Replies (10)
                          </a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Sent">Sent requests</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Bin">Bin</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Important">Important</a>
                        </li>
                        <li>
                          <a href="javascript:;" title="Starred">Urgent</a>
                        </li>
                      </ul>
                      <h5 class="b-b p-10 text-strong">Ask friends</h5>
                      <ul class="online-user" id="online-offline">
                        <li><a href="javascript:;"> <img alt="image" src="assets1/img/users/user-2.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Admin">
                            Sachin Pandit
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets1/img/users/user-1.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Content creator">
                            Sarah Smith
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets1/img/users/user-3.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Tutor">
                            Airi Satou
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets1/img/users/user-4.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Friend">
                            Angelica Ramos
                          </a></li>
                        <li><a href="javascript:;"> <img alt="image" src="assets1/img/users/user-5.png"
                              class="rounded-circle" width="35" data-toggle="tooltip" title="Chief">
                            Cara Stevens
                          </a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th colspan="1">
                              <div class="inbox-header">
                                Type concern
                              </div>
                            </th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <form class="composeForm">
                          <div class="form-group">
                            <div class="form-line">
                              <textarea type="" id="" class="form-control" placeholder="Your concern" ncols = "5" nrows = "10"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-line">
                                Label
                              <select type="" id="subject" class = "form-control" placeholder="Label">
                                <option>Important</option>
                                <option>Urgent</option>
                              </select>
                            </div>
                          </div>
                          <textarea id="ckeditor">
                            	</textarea>
                          <div class="compose-editor m-t-20">
                            <div id="summernote"></div>
                            Your Photo
                            <input type="file" class="default" multiple placeholder = "Your pic">
                          </div>
                        </form>
                      </div>
                      <div class="col-lg-12">
                        <div class="m-l-25 m-b-20">
                          <button type="button" class="btn btn-info btn-border-radius waves-effect">Send</button>
                          <button type="button" class="btn btn-danger btn-border-radius waves-effect">Discard</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
      </div>
      <footer class="main-footer">
        <div class="footer-left">
        <script>
        document.write(new Date().getFullYear())
         </script> © Cultural Portal
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets1/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets1/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets1/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="assets1/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets1/js/custom.js"></script>
</body>


<!-- email-compose.html  21 Nov 2019 03:51:00 GMT -->
</html>