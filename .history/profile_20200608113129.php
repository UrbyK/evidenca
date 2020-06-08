<?php
    if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
        echo "<script type='text/javascript'> document.location = './index.php?page=login'; </script>";
        exit();
    }

    $idusers = (int)$_SESSION['user_id'];

    $sql = "SELECT * FROM users";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idusers]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<?=template_header('Profile')?>
<div class="my-form">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card user-form">
                <div class="card-header">
                    <h1 class="card-title">Uporabniški podatki</h1>
                </div>
            <form class="content user-info" method="post">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="fname">Ime</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="fname" id="fname" value="<?=$result['fname']?>" disabled>
                    </div>
                    <label class="col-md-4 col-form-label text-md-right" for="lname">Priimek</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="lname" id="lname" value="<?=$result['lname']?>" disabled>
                    </div>
                </div>

                <div class="form-group row password">
                    <label class="col-md-4 col-form-label text-md-right" for="password">Staro geslo</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" id="old_pass" placeholder="Staro gelso" disabled required>
                    </div>

                    <label class="col-md-4 col-form-label text-md-right" for="password">Novo geslo</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" id="new_pass" placeholder="Novo geslo" disabled required>
                    </div>

                    <label class="col-md-4 col-form-label text-md-right" for="confirm_password">Potrdite geslo</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Potrdite geslo" disabled required>
                    </div>
                </div>

                <input type="button" name="edit" class="btn btn-primary" id="btnEdit" value="Uredi">
                <button type="submit" name="update" class="btn btn-primary" id="update" value="Shrani">Shrani</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#update").click(function(e){
        e.preventDefault();

        var old_pass = $( "#old_pass" ).val();
        var new_pass = $( "#new_pass" ).val();
        var confirm_password = $( "#confirm_password" ).val();

        console.log(old_pass);
        console.log(new_pass);
        console.log(confirm_password);

        console.log(country);

        $.ajax({
            type: 'POST',
            data: 'old_pass=' + old_pass + '&new_pass=' + new_pass + '&confirm_password=' + confirm_password,
            url:'./includes/user.update.inc.php',
            success:function(data){
                alert(data);
            }

        });



    })
</script>

<script>
    $(document).ready(function () {
        $('.user-info input[type=password]').prop("disabled", true);

        $("input[name=edit]").on("click", function(){
                $("input[type=password]").removeAttr("disabled");
        })
        $("input[name=update]").on("click",function(){

            $(".user-info input[type=password], .user-info input[name=update]").prop("disabled",true);

        })

    })

</script>
    

<!--
<script>

    $("#btnUpdate").click(function() {
        //var vals = $(this).serialize();

        var fname = $( "#fname" ).val();
        var lname = $( "#lname" ).val();
        var phoneNumber = $( "#phoneNumber" ).val();
        var address = $( "#address" ).val();
        var houseNumber = $("#houseNumber").val();
        var zipCode = $( "#zipCode" ).val();
        var city = $( "#city" ).val();
        var country = $( "#country" ).val();

        console.log(fname);
        console.log(lname);
        console.log(phoneNumber);
        console.log(address);
        console.log(houseNumber);
        console.log(zipCode);
        console.log(city);
        console.log(country);


        $.ajax({
                type: 'POST',
                url: './includes/user.update.inc.php',
                data: 'fname=' + fname + '&lname=' + lname + '&phoneNumber=' + phoneNumber + '&address=' + address + 
                        '&zipCode=' + zipCode + '&city=' + city + '&country=' + country,
                success: function (result) {
                    var data = jQuery.parseJSON(result);

                    location.reload();
                }
            });
        
    })

</script>
-->

<?=template_footer()?>