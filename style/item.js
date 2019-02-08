// Total price generator           
document.getElementById("item_sum").innerHTML=(item_price * item_count).toFixed(2);
function amount_calculation(valNum) {
    var result = valNum*item_price;
    if (valNum < 1) {
        document.getElementById("item_sum").innerHTML="-";
    } else {
        document.getElementById("item_sum").innerHTML=result.toFixed(2);      
    }
}

// Change background color of button "Add-to-cart" on click and load the count of added items
$(function(){
    // If this item is already in the basket
    if ((old_item_count > 0)) {
        $(".add-to-cart").css("background", "#228B22");
        $(".add-to-cart").text("Grozā ir " + old_item_count + " gab. / Mainīt daudzumu");
    }
    // Change after click
    $(".add-to-cart").on("click", function(){
        $(this).css("background", "#228B22");
        $(".add-to-cart").text("Grozā ir " + $("#count option:selected").text() + " gab. / Mainīt daudzumu");
        // Add item to basket  
        $("#basket-item-count").load (
            "comp/component_basket_additem.php",
            {count: $("#count option:selected").text(),
             article: item_article}
        );
    });
});

// Gallery script
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("gallery-slides");
    var dots = document.getElementsByClassName("gallery-demo");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}