<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Gift Genius | اقتراح هدية</title>
    <!--     Fonts and icons     -->
    <?php
    include 'layout/assets/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/Chat-Idi2oxdd.css"/>
    <link rel="stylesheet" href="./assets/css/Categories-YAZY97fB.css"/>
    <link rel="stylesheet" href="./assets/css/Chat-ve-sdNj0.css"/>
    <script type="module" src="./assets/js/hoisted-DKwnRAIk.js"></script>
</head>
<body>
<!--     Fonts and icons     -->
<?php
include 'layout/inc/header.php';
?>
<main>
    <section class="breadcrumb relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> اقتراح هدايا
                <span id="userName"></span></h1>
            <ul class="d-flex items-center  relative">
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
                <li class="separator"></li>
                <li class="linkPage">اقتراح هدايا</li>
            </ul>
        </div>
    </section>
    <section class="Chat">
        <div class="container">
            <div class="row gap-row-1 items-start"> <!-- sideBar -->
                <div class="col-3-lg col-3-md col-12-sm">
                    <aside class="SideBar-chat"><p class="fs-18 fw-500 line-big pl-5">
                            طريق استخدام الشات دون اي مشاكل <br> يحب عليك ملئ جميع الاختيارات التي تنسابك
                            وعند اكتمال هذه الاختيارات سوف يصلك الاقتراح المناسب
                        </p></aside>
                </div> <!-- chat model -->
                <div class="col-9-lg col-9-md col-12-sm">
                    <div class="Chat-model"> <!-- header -->
                        <div class="header-chat text-center mb-10 fs-r-48"><p class="chat-title">كيف يمكنني مساعدتك؟</p>
                        </div> <!-- body -->
                            <form id="chat-form" class="body-chat d-flex items-center justify-center">
                                <div> <!-- select suitable -->
                                    <div class="form-input relative mb-8"><input name="suitable" required placeholder="المناسبة" id="suitable"></div>
                                    <div class="form-input relative mb-8"><input name="relation" required placeholder="علاقتك به" id="relation"></div>
                                    <!-- select type -->
                                    <div class="form-select relative mb-8"><select name="typeSelect" id="typeSelect" required
                                                                                   class="pr-5 round-6">
                                            <option value="ذكر">ذكر</option>
                                            <option value="انثى">انثى</option>
                                        </select>
                                    </div>

                                </div> <!-- last-2 -->

                                <div> <!-- Cost -->
                                    <div class="form-input relative mb-8"><input name="interests" required placeholder="اهتماماته" id="interests"></div>

                                    <div class="form-select relative mb-8"><select name="Cost" id="Cost" required
                                                                                   class="pr-5 round-6">
                                            <option value="" disabled selected>اختر التكلفة المناسبة</option>
                                            <option value="0to50">0 - 50 </option>
                                            <option value="51to100">51 - 100 </option>
                                            <option value="101to200">101 - 200 </option>
                                            <option value="201to300">201 - 300 </option>
                                        </select></div> <!-- select-age -->
                                    <div class="form-select relative mb-8">
                                        <select name="ageSelect" id="ageSelect" required
                                                class="pr-5 round-6">
                                            <option value="" disabled selected>اختر العمر المناسب</option>
                                            <option value="under18">تحت 18</option>
                                            <option value="18to25">18 - 25</option>
                                            <option value="26to35">26 - 35</option>
                                            <option value="36to45">36 - 45</option>
                                            <option value="46to55">46 - 55</option>
                                            <option value="over55">اكبر من 55</option>
                                        </select></div>

                                </div>

                            </form>
                        <button form="chat-form" style="background: #D4576B;width: 60px;height: 40px"  id="search" class="btn btn-skew booking-btn mb-1 py-3 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500"
                                type="submit" aria-label=" بحث"> بحث
                        </button>
                        <div class="respondMassage mt-8" id="respondMassage">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <div class="container d-flex items-start justify-between">
        <div class="footer-ul about-us"><p class="title fs-24 fw-700">اعرف عنا</p>
            <p class="dec line-relaxed fs-16">
                نحن نقدم لك احدث منتجات الهدايا التي تتناسب مع جميع المناسبات بافضل
                الاسعار
            </p></div> <!--  -->
        <div class="footer-ul contact-us"><p class="title fs-24 fw-700">تواصل معانا</p>
            <p class="dec line-relaxed fs-16">gifts@gmail.com</p>
            <p class="dec line-relaxed fs-16 pt-4">gifts-2@gmail.com</p></div> <!--  -->
        <div class="footer-ul news"><p class="title fs-24 fw-700">احدث العروض</p>
            <p class="dec line-relaxed fs-16">ادخل بريدك لكي يصلك منا احدث العروض</p>
            <form action="/">
                <div class="from-group relative mt-7"><input type="email" placeholder="البريد الالكتروني"
                                                             class="round-4 pr-5">
                    <button class="btn  btn-skew sendEmails round-4 px-9  top-0 left-0" type="submit"
                            aria-label="send email">
                        ارسل
                    </button>
                </div>
            </form>
        </div>
    </div>
</footer>
<script>
    $(document).on('submit','#chat-form',function (e) {
        e.preventDefault();
        var relation = $('#relation').val();
        var suitable = $('#suitable').val();
        var typeSelect = $('#typeSelect').val();
        var interests = $('#interests').val();
        var Cost = $('#Cost').val();
        var ageSelect = $('#ageSelect').val();
        var url = "https://api.openai.com/v1/chat/completions";
        var token = "sk-proj-k4vFl7TO69JbmpXdw0WmT3BlbkFJLVLPsvszalOwzLSC4PiT";

        var message = `عاوز اقتراح هدية لشخص جنسة ${typeSelect} وعلاقتي به ${relation} وعمرة بمناسبة ${suitable} واهتمامته هى ${interests} بسعر ${Cost} `;

        console.log(message)


        $.ajax({
            url: 'https://api.openai.com/v1/chat/completions',
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'حطية هنا'
            },
            data: JSON.stringify({
                'model': 'gpt-3.5-turbo',
                'messages': [
                    {
                        'role': 'user',
                        'content':message
                    }
                ]
            }),
            success: function(responseData) {
                var assistantResponse = responseData.choices[0].message.content??'لا يوجد اقتراحات';
                $('#respondMassage').text(assistantResponse)
                console.log(responseData);
                // Handle the response here
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle errors here
            }
        });

        return true

        var data = JSON.stringify({
            'model': 'gpt-3.5-turbo',
            'messages': [{
                'role': 'user',
                'content': message
            }]
        });
        console.log(data)


        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            data: data,
            success: function(responseData) {
                var assistantResponse = responseData.choices[0].message.content??'لا يوجد اقتراحات';
                $('#respondMassage').text(assistantResponse)
                // Further processing with the assistantResponse if needed
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    })
</script>
</body>
</html>