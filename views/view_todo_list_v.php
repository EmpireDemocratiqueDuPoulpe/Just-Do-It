<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>ProjetPHP - <?= $list_name ?></title>
        <?php include_once(ROOT."/views/models/head.php"); ?>
    </head>
    <body>
        <!-- Header -->
        <?php $classes = "noShadow noFixed"; include_once(ROOT."/views/models/header.php"); ?>

        <!-- Errors and success messages -->
        <?= $errorsSuccessMsg ?>

        <!-- Todo list -->
        <div id="todoListContainer" class="maxHeight noPadding">

            <!-- Edit head -->
            <div id="todoListEditHead">
                <div id="todoListEdit">
                    <a href="./index.php"><i class="fas fa-long-arrow-alt-left"></i> Retour aux todo lists</a>

                    <!-- Form -->
                    <form action="./php/todoLists/update.php" method="POST" class="noUpperMargin <?php if($errorsSuccessMsg) echo 'errorMsgAbove'?>">

                        <!-- Todo list id -->
                        <input type="hidden" id="tId" name="id" value="<?= $list_id ?>">

                        <div class="field double">
                            <!-- Todo list name -->
                            <label for="tName"></label>
                            <input type="text" id="tName" class="noBackground" name="name" placeholder=" " value="<?= $list_name ?>" minlength="1" maxlength="32" onkeydown="this.setCustomValidity('');" required/>

                            <!-- Todo list color -->
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
                                        <input class="cSRadio" type="radio" name="color" value="purple" <?php if ($list_color == "purple") echo "checked"?>>
                                        <div class="cSColor purple"></div>
                                        <div class="cSColor purple opt"></div>
                                    </div>

                                    <!-- Blue -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="blue" <?php if ($list_color == "blue") echo "checked"?>>
                                        <div class="cSColor blue"></div>
                                        <div class="cSColor blue opt"></div>
                                    </div>

                                    <!-- Red -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="red" <?php if ($list_color == "red") echo "checked"?>>
                                        <div class="cSColor red"></div>
                                        <div class="cSColor red opt"></div>
                                    </div>

                                    <!-- Orange -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="orange" <?php if ($list_color == "orange") echo "checked"?>>
                                        <div class="cSColor orange"></div>
                                        <div class="cSColor orange opt"></div>
                                    </div>

                                    <!-- Pinkorange -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="pinkorange" <?php if ($list_color == "pinkorange") echo "checked"?>>
                                        <div class="cSColor pinkorange"></div>
                                        <div class="cSColor pinkorange opt"></div>
                                    </div>

                                    <!-- Coral -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="coral" <?php if ($list_color == "coral") echo "checked"?>>
                                        <div class="cSColor coral"></div>
                                        <div class="cSColor coral opt"></div>
                                    </div>

                                    <!-- Yellow -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="yellow" <?php if ($list_color == "yellow") echo "checked"?>>
                                        <div class="cSColor yellow"></div>
                                        <div class="cSColor yellow opt"></div>
                                    </div>

                                    <!-- Green -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="green" <?php if ($list_color == "green") echo "checked"?>>
                                        <div class="cSColor green"></div>
                                        <div class="cSColor green opt"></div>
                                    </div>

                                    <!-- Grey -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="grey" <?php if ($list_color == "grey") echo "checked"?>>
                                        <div class="cSColor grey"></div>
                                        <div class="cSColor grey opt"></div>
                                    </div>

                                    <!-- Black -->
                                    <div class="cSOption">
                                        <input class="cSRadio" type="radio" name="color" value="black" <?php if ($list_color == "black") echo "checked"?>>
                                        <div class="cSColor black"></div>
                                        <div class="cSColor black opt"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <input type="submit" value="ENREGISTRER">
                    </form>
                </div>

                <!-- Check/uncheck every tasks buttons -->
                <div id="tasksButtons">
                    <div id="tasksButtonsWrapper">
                        <button id="checkAllTasks">Cocher tout</button>
                        <button id="uncheckAllTasks">D&eacute;cocher tout</button>
                    </div>
                </div>
            </div>

            <!-- Tasks Viewer -->
            <div id="taskViewer">

                <div id="tVOngoing">
                    <div class="tVHead">
                        <span>T&acirc;ches en cours</span>
                    </div>

                    <div class="tVBody">
                        <ul class="taskContainer">
                            <?= $ongoing_task_html ?>
                        </ul>
                    </div>
                </div>

                <div id="tVDelimiter"></div>

                <div id="tVFinished">
                    <div class="tVHead">
                        <span>T&acirc;ches accomplies</span>
                    </div>

                    <div class="tVBody">
                        <ul class="taskContainer">
                            <?= $finished_task_html ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="./assets/js/bluebird.min.js"></script>
        <script src="./assets/js/AJAX.js"></script>
        <script src="./assets/js/Tasks.js"></script>
    </body>
</html>