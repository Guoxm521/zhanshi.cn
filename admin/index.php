<html>
    <style>
        frame {
            border: 1px solid #003a8c;
        }
        
    </style>
    <?php
        include './fun.php';
        islogin();
    ?>
    <frameset rows="10%,90%" frameborder='no'>
        <frame src="component/header.php" scrolling="no" >
        
            <frameset cols="15%,95%">
                <frame src="component/navLeft.php" scrolling="no" id="left"></frame>
                <frame src="component/main.php" name="main" id="main"></frame>
            </frameset>
    </frameset>
</html>></f