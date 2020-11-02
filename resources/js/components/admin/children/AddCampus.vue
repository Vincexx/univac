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
                name="name"
                label="Name of Campus"
                id="id"
                v-model="campus.name"
            ></v-text-field>

            

            <v-textarea
            clearable
            clear-icon="x"
            label="Description (Nullable)"
            v-model="campus.description"   
            ></v-textarea>

          
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
          image : ''
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
        this.$parent.$emit('hide_add_dialog')
      },
      addCampus() {
        this.form.append('name', this.campus.name);
        this.form.append('description', this.campus.description);
        this.form.append('image', this.file);

        axios.post('/api/campuses', this.form, this.config)
        .then(res => {
          this.campus.name = ''
          this.campus.description = ''
          this.previewImage = ''
          this.$parent.$emit('added_campus', 'Campus Added Successfully')
        }).catch(err => console.log(err))
      },
      fileChange(e) {
        this.file = e
        this.previewImage = URL.createObjectURL(e)
      },
      updateCampus() {
        const form = new FormData()
        form.append('name', this.campus.name);
        form.append('description', this.campus.description);
        form.append('image', this.file);
        form.append('_method', 'PUT');

        axios.post('/api/campuses/' + this.campus.id, form, this.config)
        .then(res => {
          this.previewImage = ''
          this.$parent.$emit('campus_updated', 'Selected campus updated successfully.')
        }).catch(err => console.log(err))
      }
    }
  }
</script>
