
 <!-- modal add -->
 <div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Add new Playear
          </h3>
          <button id="close-modal" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <div class="grid gap-4 mb-4 grid-cols-2">
            <!-- name -->
            <div class="col-span-2">
              <label for="namefrom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
              <input type="text" name="namefrom" id="namefrom"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="playear name" required="">
            </div>

            <!-- img url -->
            <div class="col-span-2">
              <label for="imgform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">images
                Url</label>
              <input type="text" name="imgform" id="imgform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="url" required="">
            </div>

            <!-- rating -->
            <div class="col-span-2 sm:col-span-1">
              <label for="ratingform"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
              <input type="number" name="ratingform" id="ratingform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>

            <!-- position -->
            <div class="col-span-2 sm:col-span-1">
              <label for="posform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
              <select id="posform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <!-- <option selected disabled>Select Position</option> -->
                <option value="GK">GK</option>
                <option value="LB">LB</option>
                <option value="RB">RB</option>
                <option value="CB">CB</option>
                <option value="CM">CM</option>
                <option value="LW">LW</option>
                <option value="ST" selected>ST</option>
                <option value="RW">RW</option>
              </select>
            </div>

            <!-- Pac -->
            <div class="col-span-2 sm:col-span-1">
              <label for="pacform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PAC</label>
              <input type="number" name="pacform" id="pacform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>

            <!-- SHO -->
            <div class="col-span-2 sm:col-span-1">
              <label for="shoform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SHO</label>
              <input type="number" name="shoform" id="shoform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>

            <!-- PAS -->
            <div class="col-span-2 sm:col-span-1">
              <label for="pasform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PAS</label>
              <input type="number" name="pasform" id="pasform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>

            <!-- DRI -->
            <div class="col-span-2 sm:col-span-1">
              <label for="driform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DRI</label>
              <input type="number" name="driform" id="driform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>

            <!-- DEF -->
            <div class="col-span-2 sm:col-span-1">
              <label for="defform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DEF</label>
              <input type="number" name="defform" id="defform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>

            <!-- PHY -->
            <div class="col-span-2 sm:col-span-1">
              <label for="phyform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PHY</label>
              <input type="number" name="phyform" id="phyform"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="99" required="" min="10" max="99">
            </div>





          </div>

          <button id="submit-new-player"
            class="text-white inline-flex items-center bg-orange-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
            </svg>
            Add new Playear
          </button>

        </div>
      </div>
    </div>
  </div>
