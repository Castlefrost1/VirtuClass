<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6">

                <div class="card shadow-lg my-5">
                    <div class="card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div id="error"></div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" id="a" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="b" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <a id="btn" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>
<script>
    $(function(){
        $("#btn").click(function(event)
        {
          event.preventDefault();
          $("#error").html("");
          var Username = $("#a").val();
          var Password = $("#b").val();
          console.log(Username);
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>/login/Login",
                    data:{"Username": Username,"Password": Password},
                    success:function(response)
                    {
                        console.log(response);
                        if(response == 0)
                        {
                            $("#error").html('<font color="red">Wrong Username Or Password</font>');
                        }
                        else
                        {
                            window.location.href = "<?php echo base_url();?>";
                        }
                    },
                    error: function() 
                    {
                        console.log("Test!");
                    }
                }
            );
        }); 
    });
</script>
</html>