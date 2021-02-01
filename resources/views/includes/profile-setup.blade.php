<form id="profile-setup-form" action="/action_page.php">
  <p>Skip for now</p>
  <!-- GENDER------------------------------------------------------------------------------------------------------------------------------------------------------>
  <div class="tab">
    <h4>Gender</h4>
    <div class="gender-menu">
      <div class="gender-choice male" data-gender="1">
        <i class="fas fa-male"></i>
        <span>Male</span>
      </div>
      <div class="gender-choice female" data-gender="0">
        <i class="fas fa-female"></i>
        <span>Female</span>
      </div>
    </div>
  </div>
  <!---NATIVE-LANGUAGE------------------------------------------------------------------------------------------------------------------------------------------------------>
  <div class="tab">
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
  <div class="tab">
    <h4>I am from ... </h4>
    <select class="form-control" name="nationality">
      @foreach($countries as $country)
        <option value="{{ $country->id }}">{{ $country->title }}</option>
      @endforeach
    </select>
  </div>
  <!--DOB---------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <div class="tab">
    <h4>Birthday</h4>
    <p><input placeholder="dd"  name="dd"></p>
    <p><input placeholder="mm" name="nn"></p>
    <p><input placeholder="yyyy" name="yyyy"></p>
  </div>
  <!---BIO---------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <div class="tab">
    <h4>Describe yourself</h4>
    <p>What makes you special?</p>
    <textarea class="form-control" name='bio'
               rows="5" placeholder="Your bio" spellcheck="false"></textarea>
  </div>
  <!-- CONFIRMATION -->
  <div class="tab">
    <h4>Your profile is updated</h4>
    <button type="button" class="btn btn-primary">See profile</button>
  </div>
  <!--  -->
  <div class="bottom-section">
    <div>
      <div>
        <button type="button" class="btn btn-default" id="profile-setup-prev-btn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="profile-setup-next-btn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
  </div>
</form>

<!-- REMOVED oninput="this.className = ''" FROM EVERY INPUT TAG -->
