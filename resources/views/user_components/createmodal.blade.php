<style type="text/css">
  .form-control{width: 100% !important}
</style>
<div class="modal fade" id="modal-create-user" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create New User</h4>
      </div>
      
      
      <div class="modal-body light-blue row">
              {!! Form::open(['route' => 'usermanagement.create','files' => true,'autocomplete' => 'off','onsubmit'=>'updatePasswordForm(this)']) !!}
              <div class="col-md-12" style="padding: 40px 0px 40px 0px;"> 
  
                <div class="col-md-6 form-group"  >
                    <label>Name:</label><br>
                    <input type="text" class="form-control name" name="name" required value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Email:</label><br>
                    <input type="email" class="form-control email" name="email" required value="">
                </div>
                <div class="col-md-12 form-group">
                    <br>
                </div>

                <div class="col-md-6 form-group">
                    <label>Client ID:</label><br>
                    <input type="text" class="form-control client_id" name="client_id" required value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Portfolio ID:</label><br>
                    <input type="text" class="form-control portfolio" name="portfolio" required value="">
                </div>
                <div class="col-md-12 form-group">
                    <br>
                </div>
                <?php
                $roles=[
                  'Admin'=>'Admin',
                  'Dev'=>'Developer',
                  'Client'=>'Client',
                  'Trial'=>'Trial Account',
                ];
                $countries=[
                  'US'=>'US',
                  'CA'=>'CA',
                ];
                $statues=[
                  '1'=>'Approved',
                  '0'=>'Pending',
                ];

                ?>
                <div class="col-md-4 form-group"  >
                    <label>Country:</label><br>
                    {!! Form::select('country',$countries,"US", ['class' => 'form-control ']) !!}
                </div>
                <div class="col-md-4 form-group"  >
                    <label>Status:</label><br>
                    {!! Form::select('status',$statues,"0", ['class' => 'form-control ']) !!}
                </div>
                <div class="col-md-4 form-group"  >
                    <label>Role:</label><br>
                    {!! Form::select('role',$roles,"Client", ['class' => 'form-control ']) !!}
                </div>
                <div class="col-md-12 form-group"  >
                  <br>
                </div>
                 

                
                <div class="col-md-6 form-group"  >
                    <label>New Password:</label><br>
                    <input type="password" class="form-control password" name="password" required value="">
                </div>
                <div class="col-md-6 form-group"  >
                    <label>Password Confirmation:</label><br>
                    <input type="password" class="form-control confirm_password" name="confirm_password" required value="">
                </div>
                <div class="col-md-12 form-group"  >
                  <p class="not_match" style="color: red;display: none">Password did not match with confirmation password.</p>
                  <p class="pass_length" style="color: red;display: none">Password length must be more than 8 charaptors.</p>
                </div>
                <div class="col-md-12 form-group"  >
                  <br>
                </div>
                 
              
                <div class="col-md-12" style="padding: 20px 0px 40px 0px"> 
                  <div class="col-md-12 form-group">
                      <label>Logo:</label>

                      {!!  Form::file('logo', ['class' => 'form-control logo_upload','accept'=>'.png,']) !!}
                  </div>
                </div>
                <div class="col-md-12 form-group"  >
                  <br>
                </div>
                <div class="col-md-12 modal-footer">
                      <button type="submit" class="btn btn-success"> Update</button>&nbsp;&nbsp;
                      <button class="btn btn-danger" type="button"  data-dismiss="modal"><i calss="fa fa-times"></i> Cancel</button>
                </div>
              {!! Form::close() !!} 
    
            </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
