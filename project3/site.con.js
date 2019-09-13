/*! DO NOT EDIT project3 2018-06-28 */
function Enigma(sel){
    console.log("Enigma constructor start");

    this.installListeners();
}

Enigma.prototype.installListeners = function(){
    var that = this;

    var keys = ['q', 'w', 'e', 'r', 't', 'z', 'u', 'i', 'o',
        'a', 's', 'd', 'f', 'g', 'h', 'j', 'k',
        'p', 'y', 'x', 'c', 'v', 'b', 'n', 'm', 'l'];

    for(var k=0; k<keys.length; k++){
        var key = keys[k];

        that.installListener(key);
    }

    var reset_button = $("#reset");
    reset_button.click(function (event) {
        event.preventDefault();
        console.log("press reset",reset_button);

        $.ajax({
            url: "post/enigma.php",
            data: {"reset": "Reset"},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                $("body").html(json.html);
                that.installListeners();
            }
        })

    })
}

Enigma.prototype.installListener = function(key){
    var that = this;

    var key_div_class = ".key-" + key;
    //console.log("install listener ", key_div_class);

    var button = $(key_div_class);
    //console.log("button ", button);

    button.click(function (event) {
        event.preventDefault();
        console.log("click:",button)

        var post_data = {};
        var value = key.toUpperCase();
        post_data["key"] = value;

        $.ajax({
            url: "post/enigma.php",
            data: post_data,
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                $("body").html(json.html);
                that.installListeners();
            }
        })

    });

    button.mousedown(function (event) {
        button.addClass("pressed");
    });
}
function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}