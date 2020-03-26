<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>ProjetPHP - <?= $list_name ?></title>
        <?php include_once(ROOT."/views/models/head.php"); ?>
    </head>
    <body>
        <!-- Header -->
        <?php include_once(ROOT."/views/models/header.php"); ?>

        <!-- Errors and success messages -->
        <?= $errorsSuccessMsg ?>

        <!-- Todo list -->
        <div id="todoListContainer">
            <div id="todoListEditHead">

                <!-- Form -->
                <form action="" method="POST" class="noUpperMargin <?php if($errorsSuccessMsg) echo 'errorMsgAbove'?>">

                    <!-- Todo list name -->
                    <div class="field">
                        <label for="tName"></label>
                        <input type="text" id="tName" name="name" placeholder=" " value="<?= $list_name ?>" minlength="1" maxlength="32" onkeydown="this.setCustomValidity('');" required/>
                    </div>

                    <!-- Todo list color -->
                    <div class="field inline">
                        <label for="tColor">Couleur :</label>

                        <!-- Color selector -->
                        <div id="colorSelector">
                            <input id="cSCheckbox" type="checkbox">

                            <!-- Button -->
                            <div id="cSButton">
                                <div id="selectedColor">
                                    <span></span>
                                </div>

                                <div id="arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                            <!-- Options -->
                            <div id="cSOptions">
                                <!-- Purple -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="purple" checked>
                                    <div class="cSColor purple"></div>
                                    <div class="cSColor purple opt"></div>
                                </div>

                                <!-- Blue -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="blue">
                                    <div class="cSColor blue"></div>
                                    <div class="cSColor blue opt"></div>
                                </div>

                                <!-- Red -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="red">
                                    <div class="cSColor red"></div>
                                    <div class="cSColor red opt"></div>
                                </div>

                                <!-- Orange -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="orange">
                                    <div class="cSColor orange"></div>
                                    <div class="cSColor orange opt"></div>
                                </div>

                                <!-- Pinkorange -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="pinkorange">
                                    <div class="cSColor pinkorange"></div>
                                    <div class="cSColor pinkorange opt"></div>
                                </div>

                                <!-- Coral -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="coral">
                                    <div class="cSColor coral"></div>
                                    <div class="cSColor coral opt"></div>
                                </div>

                                <!-- Yellow -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="yellow">
                                    <div class="cSColor yellow"></div>
                                    <div class="cSColor yellow opt"></div>
                                </div>

                                <!-- Green -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="green">
                                    <div class="cSColor green"></div>
                                    <div class="cSColor green opt"></div>
                                </div>

                                <!-- Grey -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="grey">
                                    <div class="cSColor grey"></div>
                                    <div class="cSColor grey opt"></div>
                                </div>

                                <!-- Black -->
                                <div class="cSOption">
                                    <input class="cSRadio" type="radio" name="color" value="black">
                                    <div class="cSColor black"></div>
                                    <div class="cSColor black opt"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
</html>