<!DOCTYPE html>
<html>
    <body>

        <p style="margin-bottom: 20px;">Hello Team,</p>
        
        <p>
            {{ $mailData['title'] }} is generated QR.
        </p>
        <p><b>QR Details:</b></p>        
        <p><b>Title:</b> {{ $mailData['title'] }} </p>
        <p><b>UUID:</b> {{ $mailData['UUID'] }} </p>
        <p><b>Type:</b> {{ $mailData['type'] }} </p>
        @if(!empty($mailData['resource_type'])){
            <p><b>Resource-Type:</b> {{ $mailData['resource_type'] }} </p>
        }
        @endif
        <p><b>Resource:</b> {{ $mailData['resource'] }} </p>
        <p><b>Is locked?:</b> {{ $mailData['is_locked'] }} </p>        
        <p><b>Owner:</b> {{ $mailData['owner_details'] }} </p>
        <div>
            {{$mailData['QR_CODE']}}
        </div>
      
        <p>Best regards,</p>
      
        <p>Laravel QR code team</p>

    </body>
</html>