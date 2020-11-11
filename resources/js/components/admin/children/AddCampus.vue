<template>
  <v-row justify="center">

    <v-dialog
      v-model="dialog"
      max-width="400"
      persistent
    >
      <v-card>
         <v-card>
        <v-card-title class="headline" v-show="!edit">Add Campus</v-card-title>
        <v-card-title class="headline" v-show="edit">Edit Campus Details</v-card-title>

        <v-card-text>

            <v-text-field
                label="Name of Campus*"
                v-model="campus.name"
                :error="error.name ? true : false"
                :error-messages="error.name"
            ></v-text-field>

            

            <v-textarea
            clearable
            clear-icon="x"
            label="Description"
            v-model="campus.description"   
            :error="error.description ? true : false"
              :error-messages="error.description"
            ></v-textarea>

            <!-- <v-text-field
                label="Link of Certificate"
                v-model="campus.certificate"
            ></v-text-field> -->

            <v-file-input
              class="mt-2"
              label="Upload File (Certificate)"
              filled
              prepend-icon="mdi-file"
              clearable
              show-size
              @change="fileChange1"
              :error="error.certificate ? true : false"
              :error-messages="error.certificate"
              
            ></v-file-input>

          
            <div v-if="campus.image && !previewImage" class="mb-2">
              <v-img :src="'/storage/' + campus.image" alt="image" v-if="edit">
              </v-img>
            </div>

            <div v-if="previewImage" class="mb-2">
              <v-img :src="previewImage" alt="image" width="100%" height="250px">
              </v-img>
            </div>

            <v-file-input
              class="mt-2"
              label="Upload Image"
              filled
              prepend-icon="mdi-camera"
              clearable
              name="image"
              id="image"
              show-size
              @change="fileChange"
               :error="error.image ? true : false"
              :error-messages="error.image"
            ></v-file-input>

            

        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="hideDialog()"
          >
            Close
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="!edit ? addCampus() : updateCampus()"
            :loading="loading"
          >
            Save
          </v-btn>
        </v-card-actions>
        
      </v-card>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props : ['showDialog', 'authUser', 'edit', 'campus_id', 'campus1'],
    data () {
      return {
        campus2 : {
          name : '',
          description : '',
          image : '',
          certificate : ''
        },
        previewImage : '',
        form : new FormData(),
        file : '',
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
        error : {
          'name' : '',
          'description' : '',
          'certificate' : '',
          'image' : ''
        },
        loading : false,
      }
      
    },
    computed : {
      dialog() {
          if(this.showDialog) {
              return this.showDialog
          } else {
              return false
          }
      },
      campus() {
          if(this.campus1) {
            return this.campus1
          } else {
            return this.campus2
          }
      }
    },
    methods : {
      hideDialog() {
        this.error = {
          'name' : '',
          'description' : '',
          'certificate' : '',
          'image' : ''
        },
        this.$parent.$emit('hide_add_dialog')
      },
      addCampus() {
        this.loading = true
        this.form.append('name', this.campus.name);
        this.form.append('description', this.campus.description);
        this.form.append('image', this.file);
        this.form.append('certificate', this.campus.certificate);

        axios.post('/api/campuses', this.form, this.config)
        .then(res => {
          this.campus.name = ''
          this.campus.description = ''
          this.previewImage = ''
          this.campus.certificate = ''
          this.error = {
            'name' : '',
            'description' : '',
            'certificate' : '',
            'image' : ''
          },
          this.loading = false
          this.$parent.$emit('added_campus', 'Campus Added Successfully')
        }).catch(err => {
          let errors = err.response.data.errors

          if(errors.name) {
            this.error.name = errors.name
          } 

          if(errors.description) {
           this.error.description = errors.description
          } 
          
          if(errors.certificate) {
           this.error.certificate = errors.certificate
          } 

          if(errors.image) {
           this.error.image = errors.image
          } 

        })
      },
      fileChange(e) {
        if(e) {
          this.file = e
          this.previewImage = URL.createObjectURL(e)
        }
      },
      updateCampus() {
        this.loading = true
        const form = new FormData()
        form.append('name', this.campus.name);
        form.append('description', this.campus.description);
        form.append('image', this.file);
        form.append('certificate', this.campus.certificate);
        form.append('_method', 'PUT');

        axios.post('/api/campuses/' + this.campus.id, form, this.config)
        .then(res => {
          this.previewImage = ''
          this.loading = false
          this.$parent.$emit('campus_updated', 'Selected campus updated successfully.')
        }).catch(err => console.log(err))
      },
       fileChange1(e) {
        if(e) {
          this.campus.certificate = e
        }
      },
    }
  }
</script>
