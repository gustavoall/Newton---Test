$(document).ready(function (){
    $('.revel-carousel').slick({
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
      });
    
    $('.revel-carousel').each(function(){
        $('.card-01').on("click", function(){
            $('.back-01').toggleClass('active');
        });
        $('.card-02').on("click", function(){
            $('.back-02').toggleClass('active');
        });
    });
    $(".btn-bars").on("click", function() {
        $(".open-menu").removeClass("disabled")
    });
    $(".btn-close").on("click", function() {
        $(".open-menu").addClass("disabled")
    });
    $(".search").on("click", function() {
        $("input").toggleClass("active")
    });    

    $('#send').click(function() {        
        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        var data = {
            name: name,
            email: email,
            subject: subject,
            message: message
        }
        if (name === '') {
            $('#name').addClass('is-invalid');
            return; 
        }
        if (email === '') {
            $('#email').addClass('is-invalid');
            return; 
        }
        if (subject === '') {
            $('#subject').addClass('is-invalid');
            return; 
        }
        if (message === '') {
            $('#message').addClass('is-invalid');
            return; 
        }
        $('#loading').fadeIn();

        $.ajax({
                url: '/newton/app/send.php',
                method: 'POST',
                data: `name=${data.name}&email=${data.email}&subject=${data.subject}&message=${data.message}`,
                success: function(response) {
                    if (response.status === 200) {
                        swal("Sucesso", response.message, "success");
                        $('#loading').fadeOut();
                    } else {
                        swal("Ops", response.message, "danger");
                        $('#loading').fadeOut();
                    }
                }
            }
        );
    });   
    
});