<div class="chat-header clearfix">
    @include('chat._header')
</div>
<div class="chat-history">
    @include('chat._chat')
</div>
<div class="chat-message clearfix">
    <form class="mb-0" action="" id="submit_message" method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="receiver_id" value="{{ $getReceiver->id }}" id="">
        @csrf
        <textarea name="message" required class="form-control emojionearea" id="ClearMessage"></textarea> 
        <div class="row">
            <div class="col-lg-6 hidden-sm">
                <a href="javascript:void(0);" id="OpenFile" style="margin-top: 10px" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                <input type="file" style="display: none" name="file_name" id="file_name">
                <span id="getFileName"></span>
            </div>
            <div class="col-md-6" style="text-align: right">
                <button class="btn btn-primary" style="margin-top: 10px" type="submit">Send</button>
            </div>
        </div>
    </form>
</div>