$(document).ready(
    $("#upgrade_info-body").hide(0).delay(500).fadeIn(1000)
)
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$(document).ready(
    $("#upgrade-body").hide(0).delay(500).fadeIn(1000)
)

//---------------LOGIN START--------------TRANG CHU START-----------TRANG CHU START----------//
$(document).ready(function () {
    if ($("body").attr("id") == "login-backg") {
        $('#vpass').click(function () {
            if ($('#vpass').hasClass('fa-eye')) {
                $('input#pass').attr('type', 'password');
                $('#vpass').addClass('fa-eye-slash');
                $('#vpass').removeClass('fa-eye');
            } else {
                $('input#pass').attr('type', 'text');
                $('#vpass').addClass('fa-eye');
                $('#vpass').removeClass('fa-eye-slash');
            }
        })
    }
})

//---------------TRANG CHU START--------------TRANG CHU START-----------TRANG CHU START----------//

$(document).ready(function () {
    // $("#ad-cate-load").click(function () {
    $("#trangchu").ready(function () {
        function load_index() {
            $.ajax({
                method: "POST",
                url: "fetchindex.php",
                dataType: "html",
                success: function (data) {
                    $('#index').html(data)
                }
            })
        }

        load_index();
    })
})




//---------------TRANG CHU END--------------TRANG CHU END-----------TRANG CHU END----------//
/*------------------APP CATE ALL------------------*/
$(document).ready(function () {
    // $("#ad-cate-load").click(function () {
    $("#appall").ready(function () {
        function load_app(page, query = '', cate = '',pay='') {
            $.ajax({
                method: "POST",
                url: "fetchallapp.php",
                data: { page: page, query: query, cate: cate,pay:pay },
                success: function (data) {
                    $('#appshowing').html(data)
                }
            })
        }

        load_app(1);

        $('#search_box').keyup(function () {
            var query = $('#search_box').val();
            var cate = $("#sortCate").val();
            var pay = $("#sortPay").val();
            load_app(1, query, cate,pay);
        })
        $("#sortCate").change(function () {
            var page = $(this).data('page_number');
            var query = $('#searchbox').val();
            var cate = $("#sortCate").val();
            var pay = $("#sortPay").val();
            load_app(1, query, cate,pay);
        })
        $("#sortPay").change(function () {
            var page = $(this).data('page_number');
            var query = $('#searchbox').val();
            var cate = $("#sortCate").val();
            var pay = $("#sortPay").val();
            load_app(1, query, cate,pay);
        })
        $(document).on('click', '.page-link', function () {
            var page = $(this).data('page_number');
            var query = $('#searchbox').val();
            var cate = $("#sortCate").val();
            var pay = $("#sortPay").val();
            load_app(page, query, cate,pay);
        })

    })
})


/*------------------APP CATE ALL------------------*/
/*------------------APP------------------*/
$(document).ready(function () {
    $("#appPage").ready(function () {
        function load_comment(appid) {
            $.ajax({
                method: "POST",
                url: "apprating.php",
                data: { aid: appid },
                success: function (data) {
                    $('#loadcomment').html(data)
                }
            })
        }

        load_comment($("#aid").val());

        function load_point(appid) {
            $.ajax({
                method: "POST",
                url: "apppoint.php",
                data: { aid: appid },
                success: function (data) {
                    $('#apoint').html(data)
                }
            })
        }

        load_point($("#aid").val());
    })
})


/*------------------APP------------------*/

//---------------PROFILE USER START--------------PROFILE USER START-----------PROFILE USER START----------//
$(document).ready(function () {
    if ($("body").attr("id") == "profilepage") {
        //-----------HAVE PICTURE URL-----------//
        $('#upload').change(function () {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            var reader = new FileReader();

            reader.onload = function (e) {
                $src = e.target.result;
                $('#profilepic').attr('src', $src);
                $('#propic').val($src);
            }
            reader.readAsDataURL(input.files[0]);
        });


        // Cho phép chỉnh sửa ở từng phần profile
        var button = $("#pTable tr td #edit");
        button.click(function () {
            var tr = $(this).parent().parent();
            var input = tr.children().eq(1).children();
            input.removeAttr("disabled");
            $(this).css("display", 'none');
            // input.attr("readonly")
        })
        //-----------SAVE PROFILE-----------//
        $("#save").click(function () {
            $("input").removeAttr("disabled");
            $("#prosub").submit();
        })

        // function test_input($data) {
        //     $data = trim($data);
        //     $data = stripslashes($data);
        //     $data = htmlspecialchars($data);
        //     return $data;
        // }
    }
})

//-------------PROFILE USER END----------------PROFILE USER END-----------------PROFILE USER END----------------//

//-------------NAP THE PAGE START----------------NAP THE PAGE START-----------------NAP THE PAGE START----------------//

$(document).ready(function () {
    if ($("body").attr("id") == "napthepage") {
        //Go to another history Type
        $("#sortSeri").click(function () {
            sortingTable(0, 'hTable');
        });
        $("#daySort").click(function () {
            sortingTable(1, 'hTable');
        });
        $("#sortValue").click(function () {
            sortNum(2, 'hTable')
        });

        // $("#findNapthe").on("keyup", function () {
        //     var value = $(this).val().toLowerCase();
        //     $("#hntBody tr").filter(function () {
        //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //     });
        // });
        createTablePagnition('#hTable', 0, 7);
    }
})
//-------------NAP THE PAGE END----------------NAP THE PAGE END-----------------NAP THE PAGE END----------------//

//Function
//Sort for td
function sortingTable(n, id) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(id);
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
function sortNum(n, id) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById(id);
    switching = true;
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            //check if the two rows should switch place:
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

//Create Pagnition
function createTablePagnition(table, currentPage, numPerPage) {
    $(table).each(function () {
        var $table = $(this);

        $table.bind('repaginate', function () {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function (event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        if (numRows > numPerPage) {
            $pager.insertAfter($table).find('span.page-number:first').addClass('active');
        }
    })
}
function squarebyID() {
    $("#id").css('height', $('#id').width() + 'px');
}

//-------------NAP THE PAGE END----------------NAP THE PAGE END-----------------NAP THE PAGE END----------------//
//-------------APP PAGE START----------------APP PAGE START-----------------APP PAGE START----------------//



//-------------APP PAGE END----------------APP PAGE END-----------------APP PAGE END----------------//

//Hide NavBar
$(document).ready(function () {
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-70px";
        }
        prevScrollpos = currentScrollPos;
    }
})
//COUNTER
$(document).ready(function () {
    if ($("body").attr("id") == "logout") {
        var counter = document.getElementById('counter');
        var count = 0;
        var wait = 10;

        var id = setInterval(() => {
            count++;
            var remain = wait - count;

            if (remain >= 0) {
                counter.innerHTML = remain;
            } else {
                clearInterval(id);
                window.location.href = 'login.php';

            }
        }, 1000);
    }

    if ($("body").attr("id") == "logrecent") {
        var counter = document.getElementById('counter');
        var count = 0;
        var wait = 10;

        var id = setInterval(() => {
            count++;
            var remain = wait - count;

            if (remain >= 0) {
                counter.innerHTML = remain;
            } else {
                clearInterval(id);
                window.location.href = './';
            }
        }, 1000);
    }
})

//NavBar ++
$(document).ready(function () {

})






//AJAX
// $(document).ready(function () {
//     $('#dtVerticalScrollExample').DataTable({
//         "scrollY": "200px",
//         "scrollCollapse": true,
//     });
//     $('.dataTables_length').addClass('bs-select');
// });

/*---- admin_listgc ---*/
/* CALLING AJAX de HIEN THI DANH SACH MA THE TAI TRANG ADMIN*/
$(document).ready(function () {
    $("#disp_listgc").click(function () {
        $.ajax({
            type: "GET",
            url: "db_ad_viewgc.php",
            dataType: "html",
            success: function (response) {
                $("#ad-disp-gc").html(response);

            }
        })
    })
})

/*---- admin_category ---*/
/* CALLING AJAX de HIEN THI DANH SACH CATEGORY TRANG ADMIN*/
$(document).ready(function () {
    $("#ad-cate-load").click(function () {
        // $("#admcate").ready(function () {
        $.ajax({
            type: "GET",
            url: "db_ad_category.php",
            dataType: "html",
            success: function (data) {
                $('#ad-cate-show').html(data)
            }
        })
    })

    $("#ad-cate-add-btn").click(function () {
        addCate();
    })

})

function viewCate() {
    $.ajax({
        type: "GET",
        url: "db_ad_category.php",
        dataType: "html",
        success: function (data) {
            $('#ad-cate-show').html(data)
        }
    })
}

function deleteCate(cate) {
    let id = cate;

    $.ajax({
        type: "GET",
        url: "db_ad_category.php?p=del",
        dataType: "html",
        data: "id=" + id,
        success: function (data) {
            viewCate();
        }
    })
}

function addCate() {
    let cate = $('#ad-cate-add-input-m').val();

    $.ajax({
        type: "POST",
        url: "db_ad_category.php?p=add",
        dataType: "html",
        data: "cate=" + cate,
        success: function (data) {
            viewCate()
        }
    })
}

function editCate(cate) {
    let ncate = $('#ad-cate-edit-input-m-' + cate).val();

    $.ajax({
        type: "POST",
        url: "db_ad_category.php?p=edit",
        dataType: "html",
        data: "cate=" + cate + "&ncate=" + ncate,
        success: function (data) {
            viewCate();
        }
    })

}

/*------------- dev_manager.php ------------------*/
/* CALLING AJAX HIEN THI DANH SACH APP CUA DEV*/
$(document).ready(function () {
    $("#dev-mana-load").click(function () {
        devname = $(this).data("value")
        dev_show_app(devname)
    })
})



function dev_show_app(devname) {
    let dname = devname

    $.ajax({
        type: "POST",
        url: "db_dev_manager.php",
        dataType: "html",
        data: "dname=" + dname,
        success: function (data) {
            $('#dev-mana-show').html(data)
        }
    })
}


function dev_del_app(devname, aid) {
    let appid = aid;
    $.ajax({
        type: "GET",
        url: "db_dev_manager.php?p=del",
        dataType: "html",
        data: "appid=" + appid,
        success: function (data) {
            dev_show_app(devname)
        }
    })
}
/*---------------------ADPORTAL----------------------------*/

$(document).ready(function () {
    $("#ad-portal-load").click(function () {
        // $("#admportal").ready(function () {
        $.ajax({
            type: "GET",
            url: "db_ad_portalload.php",
            dataType: "html",
            success: function (data) {
                $('#ad-apppending-show').html(data)
            }
        })
    })

})

$(document).ready(function () {

})






function removeTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g, " ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    // str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-| |{|}|\||\\/g, "-");
    return str;
}


