<div class="modal" id="profileSetupModal">
  <form method="POST" action="profile/{{Auth::user()->profile->id}}"
        id="profile-setup-form" class="form" role="form" autocomplete="off">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Set up profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- GENDER------------------------------------------------------------------------------------------------------------------------------------------------------>
          <div class="tab" id="genderStep">
            <h4>Gender</h4>
              <div class="gender-choice male" data-gender="1">
                <i class="fas fa-male"></i>
                <span>Male</span>
              </div>
              <div class="gender-choice female" data-gender="0">
                <i class="fas fa-female"></i>
                <span>Female</span>
            </div>
            <input type="hidden" id="gender" name="gender">
          </div>
          <!---NATIVE-LANGUAGE------------------------------------------------------------------------------------------------------------------------------------------------------>
          <div class="tab" id="langStep">
            <h4>My native language is ... </h4>
            <div class="language-menu">
              @foreach($languages as $language)
                <div class="lang-choice" data-id="{{ $language->id }}">
                  <?php $flag = \App\Helpers\Flag::getFlagForLanguage($language->code) ?>
                  <img class="lang-flag" src="{{ asset('img/flags/svg/'.$flag.'.svg') }}">
                  <span class="lang-title">{{ $language->title_native }}</span>
                </div>
              @endforeach
            </div>
            <input type="hidden" name="native-lang">
          </div>
          <!---NATIONALITY------------------------------------------------------------------------------------------------------------------------------------------------------>
          <div class="tab" id="nationStep">
            <h4>I am from ... </h4>
            <select class="form-control" name="nationality">
              @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->title }}</option>
              @endforeach
            </select>
          </div>
          <!--DOB---------------------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="tab" id="bdayStep">
            <h4>Birthday</h4>
            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <select class="form-control" name="dd">
                    @for($i = 1; $i <= 31; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <div class="col">
                  <select class="form-control" name="mm">
                    <?php 
                      $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                      $current_year = (int) date("Y");
                    ?>
                    @foreach($months as $month)
                      <option value="{{ $loop->index + 1 }}">{{$month}}</option>
                    @endforeach
                  </select>        
                </div>
                <div class="col">
                  <select class="form-control" name="yyyy">
                    @for($i = $current_year-13; $i >= $current_year-100; $i--)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!---BIO---------------------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="tab" id="bioStep">
            <h4>Describe yourself</h4>
            <p>What makes you special?</p>
            <textarea class="form-control" name='bio'
                       rows="5" placeholder="Your bio" spellcheck="false"></textarea>
          </div>
          <!-- CONFIRMATION -->
          <div class="tab">
            <h4>Your profile is updated</h4>
            <a href="/profile/{{Auth::user()->username}}" class="btn btn-primary" role="button">See profile</a>
          </div>
          
          <div class="steps">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
        </div>
        <div class="modal-footer">

          <div>
            <div>
              <button type="button" class="btn btn-default" id="profile-setup-prev-btn" onclick="nextPrev(-1)">Previous</button>
              <button type="button" class="btn btn-primary" id="profile-setup-next-btn" onclick="nextPrev(1)">Next</button>
            </div>
          </div>
          <!-- Circles which indicates the steps of the form: -->

          <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
    <input type="hidden" name="token" value="{{ Session::token() }}">
  </form>
</div>





<!-- REMOVED oninput="this.className = ''" FROM EVERY INPUT TAG -->
