<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
  <form>
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First name</label>
            <div class="mt-2">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Last name</label>
            <div class="mt-2">
              <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" autocomplete="email"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>
          <div class="sm:col-span-3">
            <label for="phone" class="block text-sm/6 font-medium text-gray-900">Phone</label>
            <div class="mt-2">
              <input type="tel" name="phone" id="phone" autocomplete="tel"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>
          <!-- Password -->
          <div class="sm:col-span-3">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
            <div class="mt-2">
              <input id="password" name="password" type="password" autocomplete="new-password"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div> 
          <!-- Confirm Password -->
          <div class="sm:col-span-3">
            <label for="confirm-password" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
            <div class="mt-2">
              <input id="confirm-password" name="confirm-password" type="password" autocomplete="new-password"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>
        
    


          <!-- Division selection -->
          <div class="sm:col-span-3">
            <label for="division" class="block text-sm/6 font-medium text-gray-900">Division</label>
            <div class="mt-2">
              <select id="division" name="division" autocomplete="address-level1"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value="">Select Division</option>
              </select>
            </div>
          </div>

          <!-- Division selection -->
          <div class="sm:col-span-3">
            <label for="district" class="block text-sm/6 font-medium text-gray-900">District</label>
            <div class="mt-2">
              <select id="district" name="district" autocomplete="address-level1"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value="">Select District</option>
              </select>
            </div>
          </div>

          <!-- Upazila selection -->
          <div class="sm:col-span-3">
            <label for="upazila" class="block text-sm/6 font-medium text-gray-900">Upazila</label>
            <div class="mt-2">
              <select id="upazila" name="upazila" autocomplete="address-level1"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value="">Select Upazila</option>
              </select>
            </div>
          </div>
          <!-- Zipcode selection -->
          <div class="sm:col-span-3">
            <label for="zipcode" class="block text-sm/6 font-medium text-gray-900">Zip code</label>
            <div class="mt-2">
              <select id="zipcode" name="zipcode" autocomplete="postal-code"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value="">Select Zip Code</option>
              </select>
            </div>
          </div>
        </div>
      </div>




      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
        <button type="submit"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
  </form>
</div>

<?php require('partials/footer.php') ?>

<script>
  //get the division json file from data/jsonpath/divisions.json and save it to divisionData --
  <?php
  $divisionData = file_get_contents('data/jsonpath/divisions.json');
  echo "const divisionData = $divisionData;";
  $districtData = file_get_contents('data/jsonpath/districts.json');
  echo "const districtData = $districtData;";
  $upazilaData = file_get_contents('data/jsonpath/upazilas.json');
  echo "const upazilaData = $upazilaData;";
  $postalCodeData = file_get_contents('data/jsonpath/postcodes.json');
  echo "const postalCodeData = $postalCodeData;";
  ?>

  const divisionSelect = document.getElementById('division');
  const districtSelect = document.getElementById('district');
  const upazilaSelect = document.getElementById('upazila');
  const postalCodeSelect = document.getElementById('zipcode');

  // Populate the division select box
  divisionData['divisions'].forEach(division => {
    const option = document.createElement('option');
    option.value = division.id;
    option.textContent = division.name;
    divisionSelect.appendChild(option);
  });

  // Populate the district select box based on the selected division
  divisionSelect.addEventListener('change', function () {
    const selectedDivisionId = this.value;
    districtSelect.innerHTML = '<option value="">Select District</option>'; // Reset district options
    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
    if (selectedDivisionId) {
      const districts = districtData['districts'].filter(district => district.division_id === selectedDivisionId);
      districts.forEach(district => {
        const option = document.createElement('option');
        option.value = district.id;
        option.textContent = district.name;
        districtSelect.appendChild(option);
      });
    }
  });
  // Populate the upazila select box based on the selected district
  districtSelect.addEventListener('change', function () {
    const selectedDistrictId = this.value;
    upazilaSelect.innerHTML = '<option value="">Select Upazila</option>';
    if (selectedDistrictId) {
      const upazilas = upazilaData['upazilas'].filter(upazila => upazila.district_id === selectedDistrictId);
      upazilas.forEach(upazila => {
        const option = document.createElement('option');
        option.value = upazila.id;
        option.textContent = upazila.name;
        upazilaSelect.appendChild(option);
      });
    }
  });
  // Populate the postal code select box based on the selected upazila name
  upazilaSelect.addEventListener('change', function () {
    const selectedUpazilaName = this.options[this.selectedIndex].textContent;
    console.log(selectedUpazilaName);
    const postalCodeSelect = document.getElementById('zipcode');
    postalCodeSelect.innerHTML = '<option value="">Select Zip Code</option>'; // Reset postal code options
    if (selectedUpazilaName) {
      console.log(postalCodeData);
      const postalCodes = postalCodeData['postcodes'].filter(postcode => postcode.upazila === selectedUpazilaName);
      console.log(postalCodes);
      postalCodes.forEach(postalCode => {
        const option = document.createElement('option');
        option.value = postalCode.postCode;
        option.textContent = postalCode.postOffice + ' - ' + postalCode.postCode;
        postalCodeSelect.appendChild(option);
      });
    }
  });

</script>