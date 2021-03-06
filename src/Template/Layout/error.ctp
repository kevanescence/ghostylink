<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->meta('favicon.ico', '/img/logos/favicon/favicon.ico', ['type' => 'icon']); ?>
        <title>Ghostylink - <?php echo $this->fetch("title"); ?></title>
        <!-- Bootstrap and others css -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <?php
        echo $this->Html->css("bootstrap.min");
        echo $this->Html->css("jquery-ui.min");
        echo $this->Html->css("common");
        echo $this->Html->css($this->name . '/' . $this->view);
//fdfs
        echo $this->fetch("css");
        echo $this->Html->script("jquery.min");
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?=
                    $this->Html->image("logos/ghostylink-logo-60x50.png", array('class' => 'logo',
                        'alt' => 'ghostylink logo'));
                    ?>
<?= $this->Html->link('Ghostylink', "/", array('class' => 'navbar-brand')); ?>
                    <h1 class="navbar-text hidden-xs">Keep control on data you share !</h1>
                </div>
                <div class="collapse navbar-collapse">
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div id="main-content" class="content-wrapper container">
<?php echo $this->fetch("content"); ?>
        </div>
        <!--</div> /.container -->
        <!-- Bootstrap and other plugins -->
        <?php echo $this->Html->script("bootstrap.min"); ?>
        <?php echo $this->Html->script("jquery-ui.min"); ?>
        <?php echo $this->Html->script("common"); ?>
        <!-- Include all scripts of the page -->
<?php echo $this->fetch("script"); ?>
    </body>
</html>