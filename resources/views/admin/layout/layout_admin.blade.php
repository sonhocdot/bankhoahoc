<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/logo code_fun.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ Request::root() . '/css/css_admin/theme.min.css' }}" />
    <link rel="stylesheet" href="{{ Request::root() . '/css/css_admin/vendor.min.css' }}" />
    <link rel="stylesheet" href="{{ Request::root() . '/js/js_admin/icon-set/style.css' }}" />
    <link rel="stylesheet" href="{{ asset('/css/css_admin/input.css') }}">
    <title>Quản trị CodeFun</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.9/tinymce.min.js"></script>
    <link rel="stylesheet" type="text/css" id="mce-u0" referrerpolicy="origin"
        href="https://cdn.tiny.cloud/1/0cvgyq8htwfa5cldcb7inwo3d6meev709oz5fuwnlml6q7iz/tinymce/5.10.4-130/skins/ui/oxide/skin.min.css">


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</head>

<body class="footer-offset footer-offset has-navbar-vertical-aside navbar-vertical-aside-show-xl">

    <!-- Search Form -->
    <div id="searchDropdown"
        class="hs-unfold-content dropdown-unfold search-fullwidth d-md-none hs-unfold-hidden hs-unfold-content-initialized hs-unfold-css-animation animated"
        data-hs-target-height="0" data-hs-unfold-content="" data-hs-unfold-content-animation-in="fadeIn"
        data-hs-unfold-content-animation-out="fadeOut" style="animation-duration: 300ms;">
        <form class="input-group input-group-merge input-group-borderless">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="tio-search"></i>
                </div>
            </div>

            <input class="form-control rounded-0" type="search" placeholder="Search in front"
                aria-label="Search in front" />

            <div class="input-group-append">
                <div class="input-group-text">
                    <div class="hs-unfold">
                        <a class="js-hs-unfold-invoker" href="javascript:;"
                            data-hs-unfold-options='{
                     "target": "#searchDropdown",
                     "type": "css-animation",
                     "animationIn": "fadeIn",
                     "hasOverlay": "rgba(46, 52, 81, 0.1)",
                     "closeBreakpoint": "md"
                   }'
                            data-hs-unfold-target="#searchDropdown" data-hs-unfold-invoker="">
                            <i class="tio-clear tio-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Search Form -->

    <!-- ========== HEADER ========== -->
    @include('admin.blocks.header')
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Navbar Vertical -->
    @include('admin.blocks.sidebar')
    <!-- End Navbar Vertical -->

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">

            @yield('main')

            <!-- End Row -->
        </div>
        <!-- End Content -->

        <!-- Footer -->
        @include('admin.blocks.footer')
        <!-- End Footer -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->


    <!-- End New project Modal -->
    <!-- ========== END SECONDARY CONTENTS ========== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ Request::root() . '/js/js_admin/vendor.min.js' }}"></script>
    <script src="{{ Request::root() . '/js/js_admin/theme.min.js' }}"></script>


    {{-- Tìm kiếm và chọn bài viết liên quan --}}
    <script src="{{ Request::root() . '/js/js_admin/multisearch.js' }}"></script>
    <script>
        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)')
            .matches
        tinymce.init({
            selector: 'input#mytextarea',
            plugins: 'print visualblocks image preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            content_css: 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
            formats: {

                bold: {
                    inline: 'strong',
                    classes: 'bold'
                },
                italic: {
                    inline: 'i',
                    classes: 'italic'
                },
                underline: {
                    inline: 'u',
                    classes: 'underline',
                    exact: true
                },
                strikethrough: {
                    inline: 'del'
                },
                forecolor: {
                    inline: 'span',
                    classes: 'forecolor',
                    styles: {
                        color: '%value'
                    }
                },
                hilitecolor: {
                    inline: 'span',
                    classes: 'hilitecolor',
                    styles: {
                        backgroundColor: '%value'
                    }
                },
                custom_format: {
                    block: 'h1',
                    attributes: {
                        title: 'Header'
                    },
                    styles: {
                        color: 'red'
                    }
                }
            },
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    })
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    })
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    })
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 1000,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            style_formats: [{
                    title: 'Headers',
                    items: [{
                            title: 'h1',
                            block: 'h1'
                        },
                        {
                            title: 'h2',
                            block: 'h2'
                        },
                        {
                            title: 'h3',
                            block: 'h3'
                        },
                        {
                            title: 'h4',
                            block: 'h4'
                        },
                        {
                            title: 'h5',
                            block: 'h5'
                        },
                        {
                            title: 'h6',
                            block: 'h6'
                        }
                    ]
                },

                {
                    title: 'Blocks',
                    items: [{
                            title: 'p',
                            block: 'p'
                        },
                        {
                            title: 'div',
                            block: 'div'
                        },
                        {
                            title: 'pre',
                            block: 'pre'
                        }
                    ]
                },

                {
                    title: 'Containers',
                    items: [{
                            title: 'section',
                            block: 'section',
                            wrapper: true,
                            merge_siblings: false
                        },
                        {
                            title: 'article',
                            block: 'article',
                            wrapper: true,
                            merge_siblings: false
                        },
                        {
                            title: 'blockquote',
                            block: 'blockquote',
                            wrapper: true
                        },
                        {
                            title: 'hgroup',
                            block: 'hgroup',
                            wrapper: true
                        },
                        {
                            title: 'aside',
                            block: 'aside',
                            wrapper: true
                        },
                        {
                            title: 'figure',
                            block: 'figure',
                            wrapper: true
                        }
                    ]
                }
            ],
            visualblocks_default_state: true,
            end_container_on_empty_block: true,
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
    <script>
        // valitade password
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>
    <script>
        $('.js-navbar-vertical-aside-menu-link ').click(function() {
            console.log("click")
            $(this).parent().children('.nav-sub').toggleClass('d-block')
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các nút có class toggle-navbar
            const toggleButtons = document.querySelectorAll('.toggle-navbar');

            // Lấy các phần tử cần toggle class
            const verticalAside = document.querySelector('.js-navbar-vertical-aside');
            const mobileOverlay = document.querySelector('.js-navbar-vertical-aside-toggle-invoker');

            // Thêm sự kiện click cho mỗi nút
            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Toggle class cho aside
                    if (verticalAside) {
                        verticalAside.classList.toggle('navbar-vertical-aside-initialized');
                    }

                    // Toggle class cho overlay
                    if (mobileOverlay) {
                        mobileOverlay.classList.toggle('navbar-vertical-aside-mobile-overlay');
                    }
                });
            });
        });
    </script>

    <script>
        var loadFile = function(e) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        var deleteImg = function(e) {
            var output = document.getElementById('output');
            output.src = '';
        };

        function toSlug(str) {
            // Chuyển hết sang chữ thường
            str = str.toLowerCase();

            // xóa dấu
            str = str
                .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

            // Thay ký tự đĐ
            str = str.replace(/[đĐ]/g, 'd');

            // Xóa ký tự đặc biệt
            str = str.replace(/([^0-9a-z-\s])/g, '');

            // Xóa khoảng trắng thay bằng ký tự -
            str = str.replace(/(\s+)/g, '-');

            // Xóa ký tự - liên tiếp
            str = str.replace(/-+/g, '-');

            // xóa phần dư - ở đầu & cuối
            str = str.replace(/^-+|-+$/g, '');

            // return
            return str;
        }

        var onChangeInput = function(e, id) {
            var ele = document.getElementById(id);
            console.log(event.target.value);
            document.getElementById("slug").value = toSlug(event.target.value).split(' ').join('-');
            document.getElementById("metaTitle").value = event.target.value;
        }
        var onChangeInput_edit = function(e, id) {
            if (confirm("Bạn có muốn thay đổi slug") == true) {
                var ele = document.getElementById(id);
                console.log(event.target.value);
                document.getElementById("slug").value = toSlug(event.target.value).split(" ").join("-");
            }
            document.getElementById("metaTitle").value = event.target.value;
        }
    </script>
    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent))
            document.write(
                '<script src="../assets/vendor/babel-polyfill/polyfill.min.js"><\/script>'
            )
    </script>
    <script>
        const tieu_de = document.querySelector('#tieu_de')
        const mo_ta = document.getElementById('mo_ta')
        const count = document.getElementById('count')
        const count1 = document.getElementById('count1')
        // const max =60;
        console.log();
        count.innerHTML = tieu_de.value.length;
        count1.innerHTML = mo_ta.value.length;
        tieu_de.onkeyup = (e) => {
            // if(e.target.value.length > max){
            //     alert("Bạn nhập quá số ký tự quy định");
            // }
            count.innerHTML = e.target.value.length;
        };

        mo_ta.onkeyup = (e) => {

            count1.innerHTML = e.target.value.length;
        };
    </script>
    <div class="hs-unfold-overlay"></div>
</body>

</html>
