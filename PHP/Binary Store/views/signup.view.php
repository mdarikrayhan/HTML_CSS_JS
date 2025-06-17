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
        <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
        <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p>

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

          <div class="sm:col-span-4">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" autocomplete="email"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>
          <!-- There should be option for district selection from json file -->
          <!-- json file location: /data/districts.json -->

          <div class="col-span-full">
            <label for="street-address" class="block text-sm/6 font-medium text-gray-900">Street address</label>
            <div class="mt-2">
              <input type="text" name="street-address" id="street-address" autocomplete="street-address"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <!-- Division selection -->
          <div class="sm:col-span-6">
            <label for="division" class="block text-sm/6 font-medium text-gray-900">Division</label>
            <div class="mt-2">
              <select id="division" name="division" autocomplete="address-level1"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <option value="">Select Division</option>
                <?php
                $divisions = json_decode(file_get_contents('data/jsonpath/divisions.json'), true);
                foreach ($divisions['divisions'] as $division) {
                  echo "<option value=\"{$division['name']}\">{$division['name']}</option>";
                }
                ?>
              </select>
            </div>
          </div>


            <div class="sm:col-span-6">
              <label for="district" class="block text-sm/6 font-medium text-gray-900">District</label>
              <div class="mt-2">
                <select id="district" name="district" autocomplete="address-level1"
                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  <option value="">Select District</option>
                  <?php
                  $districts = json_decode(file_get_contents('data/jsonpath/districts.json'), true);
                  foreach ($districts['districts'] as $district) {

                  }
                  ?>
                </select>
                <?php
                $division = isset($_POST['division']) ? $_POST['division'] : '';
                echo "$division";
                ?>
              </div>
            </div>

              <div class="sm:col-span-2 sm:col-start-1">
                <label for="city" class="block text-sm/6 font-medium text-gray-900">City</label>
                <div class="mt-2">
                  <input type="text" name="city" id="city" autocomplete="address-level2"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label for="region" class="block text-sm/6 font-medium text-gray-900">State / Province</label>
                <div class="mt-2">
                  <input type="text" name="region" id="region" autocomplete="address-level1"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label for="postal-code" class="block text-sm/6 font-medium text-gray-900">ZIP / Postal code</label>
                <div class="mt-2">
                  <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
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
  document.addEventListener('DOMContentLoaded', function () {
    const divisionSelect = document.getElementById('division');
    const divisionId = <?php echo json_encode(array_column($divisions['divisions'], 'id')); ?>;
    const districtSelect = document.getElementById('district');

    divisionSelect.addEventListener('change', function () {
      const selectedDivision = this.value;
      fetch('data/jsonpath/districts.json')
        .then(response => response.json())
        .then(data => {
          districtSelect.innerHTML = '<option value="">Select District</option>';
          data.districts.forEach(district => {
            if (district.division_id === divisionId[divisionSelect.selectedIndex - 1]) {
              const option = document.createElement('option');
              option.value = district.name;
              option.textContent = district.name;
              districtSelect.appendChild(option);
            }
          });
        });
    });


  });

</script>