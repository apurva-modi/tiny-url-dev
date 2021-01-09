<template>
<h1 class="text-3xl py-4 border-b mb-10">TinyUrl- A URL Shortner Service</h1>
  <div class="flex justify-center">
      <div class="w-full bg-white p-6 rounded-lg">
        <form @submit="formSubmit">
            <div class="mb-4">
               
                <textarea type="text" id="url" name="url" class="bg-gray-100 border-2 w-full p-4 rounded-lg"  placeholder="Enter a URL" v-model="url" ></textarea>
                <p v-if="output.errors" class="text-xs font-semibold text-red-600 italic">
                    {{output.errors.link[0]}}
                </p>
            </div>
            <div class="mb4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium" type="submit">Shorten the Link</button>
            </div>
        </form>

          <div v-if="!output.errors && output" class="text-green-500 mt-2 text-sm">
                {{output.msg}}
          </div>
          <div v-if="!output.errors && output" class="overflow-x-auto rounded-lg" style="margin: 10px;">
            <table class="table-fixed shadow-lg ">
                <thead>
                    <tr>
                        <th class="bg-blue-100 border text-left px-8 py-4">TinyUrl</th>
                        <th class="bg-blue-100 border text-left px-8 py-4">Actual URL</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="border px-8 py-4 bg-white"><a class = "hover:bg-blue-50" href={{output.shortenedUrl}} target="_blank"> </a> {{output.shortenedUrl}} </td>
                            <td class="border px-8 py-4 bg-white"> {{output.originalUrl}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'UrlShortner',
  data: function(){
      return {
          output: "",
          errorOutput: "",
      }
  },
  methods: {
    formSubmit: function(e) {
        e.preventDefault();
        let currentObj = this;
        this.axios.post('http://127.0.0.1:8000/api/generate-link/', {
            link: this.url
        }, {
            "content-type": "application/json",
            "Accept": "application/json"
        })
        .then(function (response) {
            currentObj.output = response.data;
        })
        .catch(function (error) {
            if(error.response){
                currentObj.output = error.response.data;
            }
            else{
                currentObj.output = error;
            }
        });
    }
  }
//   props: {
//     msg: String
//   }
}
</script>