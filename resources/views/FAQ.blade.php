@extends('layouts.app')

@section('content')
<script type="text/javascript">
        $(".tag-filter li").click(function (e) {
            var currentTag = this.className;
            if (currentTag == "all") {
                $(".faqElement").show();
            } else {
                $(".faqElement").hide();
                $(".faqElement" + "." + currentTag).show();
            }
            e.preventDefault();
        });
</script>
<div class="container1">
    <div class="row justify-content-center">
        <h1>Frequently Asked Questions</h1> 
    </div><br>
    <div class="tag-filter">
        <ul>
            <li class="navItem all active">
                <a href="#">All</a>
            </li>
            <li class="navItem forgotten-password">
                <a href="#forgotten-password">Forgotten Password</a>
            </li>
            <li class="navItem inactive-user">
                <a href="#inactive-user">Inactive User</a>
            </li>
            <li class="navItem no-credit">
                <a href="#no-credit">No Credit</a>
            </li>
        </ul>
    </div><br>
    <div id="forgotten-password" class="faqElement forgotten-password">
        <h2>I forgot my password</h2>
        <p>
            Please click on the link that says '<a href="{{ route('password.request') }}" style="text-decoration: none; color: #0595d2;">Forgot your password?</a>' and enter your email (which is your company email address). A link will then be emailed, enabling you to reset it.
            <br><br>
            If you are still having trouble accessing your account, please use the contact information.
            <br><br>
        </p>    
    </div>
    <div id="inactive-user" class="faqElement change-password">
        <h2>In-active User</h2>
        <p>If the user is considered as inactive, HR will disable his account so even the account has credit amount. They're unable to use it.</p>
        <br><br>
    </div>
    <div id="no-credit" class="faqElement no-credit">
        <h2>I have no credit balance</h2>
        <p>Please contact HR Divine and ask her to apply a credit amount for your account.</p>
        <br><br>
    </div>

</div>
<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>




@endsection
