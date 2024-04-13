<?php
require('system/helper.php');

$selectCategoriesSql = 'SELECT * FROM main_categories order by id DESC';
$selectCategoriesResult = runQuery($selectCategoriesSql);

?>


<nav class="topNav absolute top-0 py-5">
    <div class="container">
        <div class="icons d-flex items-center gap-y-5">
            <svg width="24" height="24" viewBox="0 0 24 24" data-icon="facebook">
                <symbol id="ai:local:facebook">
                    <path fill="currentColor"
                          d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4z"/>
                </symbol>
                <use xlink:href="#ai:local:facebook"></use>
            </svg>
            <svg width="24" height="24" viewBox="0 0 24 24" data-icon="inst">
                <symbol id="ai:local:inst">
                    <path fill="currentColor"
                          d="M12.001 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6m0-2a5 5 0 1 1 0 10 5 5 0 0 1 0-10m6.5-.25a1.25 1.25 0 0 1-2.5 0 1.25 1.25 0 0 1 2.5 0M12.001 4c-2.474 0-2.878.007-4.029.058-.784.037-1.31.142-1.798.332a2.886 2.886 0 0 0-1.08.703 2.89 2.89 0 0 0-.704 1.08c-.19.49-.295 1.015-.331 1.798C4.007 9.075 4 9.461 4 12c0 2.475.007 2.878.058 4.029.037.783.142 1.31.331 1.797.17.435.37.748.702 1.08.337.336.65.537 1.08.703.494.191 1.02.297 1.8.333C9.075 19.994 9.461 20 12 20c2.475 0 2.878-.007 4.029-.058.782-.037 1.308-.142 1.797-.331a2.91 2.91 0 0 0 1.08-.703c.337-.336.538-.649.704-1.08.19-.492.296-1.018.332-1.8.052-1.103.058-1.49.058-4.028 0-2.474-.007-2.878-.058-4.029-.037-.782-.143-1.31-.332-1.798a2.912 2.912 0 0 0-.703-1.08 2.884 2.884 0 0 0-1.08-.704c-.49-.19-1.016-.295-1.798-.331C14.926 4.006 14.54 4 12 4m0-2c2.717 0 3.056.01 4.123.06 1.064.05 1.79.217 2.427.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.884 4.884 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465-1.067.047-1.406.06-4.123.06-2.717 0-3.056-.01-4.123-.06-1.064-.05-1.789-.218-2.427-.465a4.89 4.89 0 0 1-1.772-1.153 4.905 4.905 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.012 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.065.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.637-.248 1.362-.415 2.427-.465C8.945 2.013 9.284 2 12.001 2"/>
                </symbol>
                <use xlink:href="#ai:local:inst"></use>
            </svg>
            <svg width="24" height="24" viewBox="0 0 16 16" data-icon="twitter">
                <symbol id="ai:local:twitter">
                    <path fill="currentColor"
                          d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/>
                </symbol>
                <use xlink:href="#ai:local:twitter"></use>
            </svg> <!-- <Icon name={`facebook`} size={24} /> --> </div>
    </div>
</nav>
<header class="absolute">
    <div class="container">
        <nav class="d-flex items-center justify-between py-5">
            <ul class="iconList d-flex items-center">
                <li class="nav-items"><a href="cart.php" class="nav-link mt-3">
                        <svg width="1em" height="1em" viewBox="0 0 512 512" data-icon="cart2">
                            <use xlink:href="#ai:local:cart2"></use>
                        </svg>
                    </a></li>
                <li class="dropdown nav-items pr-8 relative d-flex items-center openDropDown" data-drop="drop-0"><span
                            class="fw-700 nav-link relative openDropDown"  data-drop="drop-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" class="pr-1 openDropDown" data-drop="drop-0"
                             data-icon="user">  <symbol id="ai:local:user"><path
                                        fill="currentColor"
                                        d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5M20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1z"/></symbol><use
                                    xlink:href="#ai:local:user"></use>  </svg> </span>
                    <svg width="18" height="18" viewBox="0 0 24 24" id="arrowDropDown" class="openDropDown"  data-drop="drop-0" data-icon="arrow-down">
                        <symbol id="ai:local:arrow-down">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m7 10 5 5 5-5"/>
                        </symbol>
                        <use xlink:href="#ai:local:arrow-down"></use>
                    </svg>
                    <ul class="dropdown-content round-6 overflow-hidden d-none right-0 absolute" style="height: auto" id="drop-0">
                        <li class=""><a href="signUp.php" class="fw-500 px-7 py-4 relative"> انشاء حساب</a></li>
                        <li class=""><a href="signIn.php" class="fw-500 px-7 py-4 relative">
                                تسجيل الدخول
                            </a></li>
                    </ul>
                </li>
            </ul>
            <a href="index.php" class="logo mx-auto"> <img src="./assets/images/gifts-AELogo-Cz-3vIdu_86Imp.webp"
                                                           alt="logo for Gift Genius " class="img-cover" loading="eager"
                                                           width="620" height="559" decoding="async"> </a>
            <button class="btn icon-nav-base" type="button" aria-label="open menu">
                <span></span><span></span><span></span></button>
            <ul class="d-flex items-center link-list normalMenu">
                <li class="nav-items pr-8"><a class="fw-500 nav-link  relative" href="index.php"> الرئيسية </a></li>
                <li class="nav-items pr-8"><a class="fw-500 nav-link  relative" href="product.php"> منتجاتنا </a></li>
                <li class="nav-items pr-8"><a class="fw-500 nav-link  relative" href="ContactUs.php"> تواصل معنا </a>
                </li>

                <?php
                if ($selectCategoriesResult->num_rows > 0) {
                    while ($row = $selectCategoriesResult->fetch_assoc()) {
                        $selectSubCategoriesSql = "SELECT * FROM sub_categories Where `main_id`= {$row['id']} order by id DESC";
                        $selectSubCategoriesResult = runQuery($selectSubCategoriesSql);
                        ?>
                        <li class="dropdown nav-items pr-8 relative d-flex items-center openDropDown"
                            data-drop="drop-<?php echo $row['id']; ?>"><span
                                    class="fw-500 nav-link relative openDropDown"
                                    data-drop="drop-<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></span>
                            <svg width="24" height="24" viewBox="0 0 24 24" class="pr-1 openDropDown"
                                 data-drop="drop-<?php echo $row['id']; ?>" id="arrowDropDown"
                                 data-icon="arrow-down">
                                <use xlink:href="#ai:local:arrow-down"></use>
                            </svg>
                            <ul class="dropdown-content round-6 overflow-hidden d-none right-0 absolute"
                                style="height: auto" id="drop-<?php echo $row['id']; ?>">
                                <?php
                                if ($selectSubCategoriesResult->num_rows > 0) {
                                    while ($subRow = $selectSubCategoriesResult->fetch_assoc()) {

                                        ?>
                                        <li class=""><a href="Categories.php?id=<?php echo $subRow['id']; ?>"
                                                        class="fw-500 px-7 py-4 relative">
                                                <?php echo $subRow['name']; ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>

                <!--                <li class="dropdown nav-items pr-8 relative d-flex items-center" id="drop1">-->
                <!--                    <span-->
                <!--                            class="fw-500 nav-link relative"> رجالي</span>-->
                <!--                    <svg width="24" height="24" viewBox="0 0 24 24" class="pr-1" id="arrowDropDown"-->
                <!--                         data-icon="arrow-down">-->
                <!--                        <use xlink:href="#ai:local:arrow-down"></use>-->
                <!--                    </svg>-->
                <!--                    <ul class="dropdown-content round-6 overflow-hidden d-none right-0 absolute">-->
                <!--                        <li class=""><a href="Categories.html" class="fw-500 px-7 py-4 relative">-->
                <!--                                اعياد الميلاد</a></li>-->
                <!--                        <li class=""><a href="Categories.html" class="fw-500 px-7 py-4 relative">-->
                <!--                                اعياد الجواز</a></li>-->
                <!--                        <li class=""><a href="Categories.html" class="fw-500 px-7 py-4 relative">-->
                <!--                                عيد الحب</a></li>-->
                <!--                        <li class=""><a href="Categories.html" class="fw-500 px-7 py-4 relative">-->
                <!--                                عيد الام</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->


            </ul>
        </nav>
    </div>
</header>