<!DOCTYPE html>

<html>

<head>

    <title>Directory listing of <?php echo $_SERVER["HTTP_HOST"] ?></title>
    <link rel="shortcut icon" href="/img/favicon.png">

    <!-- STYLES -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/style.css">

    <!-- SCRIPTS -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/directorylister.js"></script>

    <!-- FONTS -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cutive+Mono">

    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

</head>

<body>

<div id="page-navbar" class="navbar navbar-default navbar-fixed-top">
    <div class="container">

		<?php $breadcrumbs = $lister->listBreadcrumbs(); ?>

        <p class="navbar-text">
			<?php foreach ( $breadcrumbs as $breadcrumb ): ?>
				<?php if ( $breadcrumb != end( $breadcrumbs ) ): ?>
                    <a href="<?php echo $breadcrumb['link']; ?>"><?php echo $breadcrumb['text']; ?></a>
                    <span class="divider">/</span>
				<?php else: ?>
					<?php echo $breadcrumb['text']; ?>
				<?php endif; ?>
			<?php endforeach; ?>
        </p>

        <div class="navbar-right">

            <ul id="upload-nav" class="nav navbar-nav">
                <li>
                    <a href="javascript:void(0)" id="upload_btn" title="Upload">
                        <i class="fa fa-arrow-circle-up fa-lg"></i>
                    </a>
                </li>
            </ul>

            <ul id="settings-nav" class="nav navbar-nav" title="Settings">
                <li>
                    <a href="javascript:void(0)" id="settings-link">
                        <i class="fa fa- fa-cog fa-lg"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li>
                    <a href="/resources/scripts/logout.php" title="Sign out"><i class="fa fa-sign-out fa-lg"></i></a>
                </li>
            </ul>

        </div>
    </div>
</div>

<div id="page-content" class="container">

	<?php if ( $lister->getSystemMessages() ): ?>
		<?php foreach ( $lister->getSystemMessages() as $message ): ?>
            <div class="alert alert-<?php echo $message['type']; ?>">
				<?php echo $message['text']; ?>
                <a class="close" data-dismiss="alert" href="#">&times;</a>
            </div>
		<?php endforeach; ?>
	<?php endif; ?>

    <div id="directory-list-header">
        <div class="row">
            <div class="col-md-7 col-sm-6 col-xs-10">File</div>
            <div class="col-md-2 col-sm-2 col-xs-2 text-right">Size</div>
            <div class="col-md-3 col-sm-4 hidden-xs text-right">Last Modified</div>
        </div>
    </div>

    <ul id="directory-listing" class="nav nav-pills nav-stacked">

		<?php foreach ( $dirArray as $name => $fileInfo ): ?>
            <li data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
                <a href="<?php echo $fileInfo['url_path']; ?>" class="clearfix" data-name="<?php echo $name; ?>">


                    <div class="row">
                                <span class="file-name col-md-7 col-sm-6 col-xs-9">
                                    <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
	                                <?php echo $name; ?>
                                </span>

                        <span class="file-size col-md-2 col-sm-2 col-xs-3 text-right">
                                    <?php echo $fileInfo['file_size']; ?>
                                </span>

                        <span class="file-modified col-md-3 col-sm-4 hidden-xs text-right">
                                    <?php echo $fileInfo['mod_time']; ?>
                                </span>
                    </div>

                </a>

				<?php if ( $name != ".." ): ?>
                <form action="/resources/scripts/delete.php" method="post" class="delete-form <?=$fileInfo["id"]?>-form">
                    <input title="" name="path" value="<?php echo $fileInfo['url_path']; ?>" style="display: none">
                    <a href="javascript:$('.<?=$fileInfo["id"]?>-form').submit()" class="delete-button">
                        <i class="fa fa-trash"></i>
                    </a>
                </form>
				<?php endif; ?>

				<?php if ( is_file( $fileInfo['file_path'] ) ): ?>

                    <a href="javascript:void(0)" class="file-info-button">
                        <i class="fa fa-download"></i>
                    </a>

				<?php endif; ?>

				<?php if ( end( explode( ".", $fileInfo['file_path'] ) ) == "zip" ): ?>

                    <a href="javascript:void(0)" class="file-unzip-button">
                        <i class="fa fa-file-archive-o"></i>
                    </a>

				<?php endif; ?>

            </li>
		<?php endforeach; ?>

    </ul>
</div>

<div id="file-info-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{modal_header}}</h4>
            </div>

            <div class="modal-body">

                <table id="file-info" class="table table-bordered">
                    <tbody>

                    <tr>
                        <td class="table-title">MD5</td>
                        <td class="md5-hash">{{md5_sum}}</td>
                    </tr>

                    <tr>
                        <td class="table-title">SHA1</td>
                        <td class="sha1-hash">{{sha1_sum}}</td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>

<div id="file-upload-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{modal_header}}</h4>
            </div>

            <div class="modal-body">
                <form id="upload-form" action="/resources/scripts/upload.php" method="post"
                      enctype="multipart/form-data" class="form-inline">
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                    <input type="submit" value="Upload File" class="btn btn-primary" name="submit">
                </form>
            </div>

        </div>
    </div>
</div>

<div id="settings-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{modal_header}}</h4>
            </div>

            <div class="modal-body">
                <form id="change-password" action="/resources/scripts/update_profile.php" method="post"
                      class="form-inline">
                    <label for="password">New Password: </label><input class="form-control" type="password"
                                                                       name="password" id="password">
                    <input type="submit" value="Change password" name="submit" class="btn btn-primary">
                </form>
            </div>

        </div>
    </div>
</div>

</body>

</html>
