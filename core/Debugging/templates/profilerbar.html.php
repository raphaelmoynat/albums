<div
style="
background-color: red;
position: fixed;
z-index: -1;
bottom :0;
width: 100vw;
height:10vh;
display: flex;
justify-content: space-around;
align-items: center;
"
>
    <span>Debug Mode On</span>

    <span>
        <span>Auth :</span>
        <span>
            <?php
            if(\Core\Session\Session::userConnected()){
                echo \Core\Session\Session::user()['id']." : ".\Core\Session\Session::user()['username'];
            }else{
                echo "Anonymous";
            }
            ?>
        </span>
    </span>

    <span>
        <a href="http://localhost:4372"><strong>Profiler</strong></a>
    </span>

</div>