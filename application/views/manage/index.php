
    <div class="container">
        <div class="row" style="min-height: 420px; overflow: hidden;">
            <div class="span3">
            </div>
            <div class="span6">
                <h1 style="min-height: 100px;" class="text-center"><img src="../assets/img/search-logo.jpg"></h1>
                <div class="input-append ">
                    <input class="span5 input-xlarge" id="appendedInputButton" type="text" placeholder="搜索@host #node ~ip ">
                    <button class="btn btn-primary" type="button">搜索</button>
                </div>
            </div>

        </div>
    </div>

<script>

    $(
        $('button.btn').click(function(){
            $.messager.alert('','暂时你还搜不到啥东西哦','error');
        })
    );
</script>