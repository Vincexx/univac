<template>
  <v-row justify="center">

    <v-dialog
      v-model="dialog"
      max-width="400"
      persistent
    >
      <v-card>
         <v-card>
        <v-card-title class="headline" v-show="!edit">Other Document</v-card-title>
        <v-card-title class="headline" v-show="edit">Edit Document</v-card-title>

        <v-card-text>
              
              <!-- <v-select
                :items="documents_name"
                label="Select Document"
                dense
                v-model="other_document.name"
              ></v-select> -->

            <v-text-field
              label="Name of Campus*"
              v-model="other_document.name"
          ></v-text-field>

            <v-file-input
              class="mt-2"
              placeholder="Upload File (Document)"
              filled
              prepend-icon="mdi-file"
              clearable
              show-size
              @change="fileChange"    
              label="In portable document format (pdf)"    
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
            :loading="loading"
            @click="!edit ? addDocument() : updateDocument()"
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
    props : ['showDialog', 'authUser', 'edit', 'otherdocument'],
    data () {
      return {
        documents_name : [
            'Accreditation Status',
            'Survey Visit Schedule',
            'Accomplishment Report',
            'List of Internal Accreditors',
            'Organizational Structure',
        ],
        loading : false,
        other_document1 : {
          name : '',
          file : ''
        },
        errorName : '',
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
      
      }
      
    },
    computed : {
      other_document() {
          if(this.otherdocument) {
            return this.otherdocument
          } else {
            return this.other_document1
          }
      },

      dialog() {
          if(this.showDialog) {
              return this.showDialog
          } else {
              return false
          }
      },
   
    },
    methods : {
        hideDialog() {
            this.other_document.name = ''
            this.other_document.file = ''
            this.$parent.$emit('hide_dialog')
        },
        fileChange(e) {
          if(e) {
            this.other_document.file = e
          }
        },
        addDocument() {
          this.loading = true
          const form = new FormData()
          form.append('name', this.other_document.name);
          form.append('file', this.other_document.file);

          axios.post('/api/other-documents', form, this.config)
          .then(res => {
            this.loading = false
            this.other_document.name = ''
            this.other_document.file = ''
            this.$parent.$emit('document_added', res.data.message)
          })
          .catch(err => {
            this.loading = false
            console.log(err)
          })
        },
        updateDocument() {
          this.loading = true
          const form = new FormData()
          form.append('name', this.other_document.name);
          form.append('file', this.other_document.file);
          form.append('_method', 'PUT');

          axios.post('/api/other-documents/' + this.other_document.id, form, this.config)
          .then(res => {
            this.loading = false
            this.other_document.name = ''
            this.other_document.file = ''
            this.$parent.$emit('document_updated', res.data.message)
          }).catch(err => {
            this.loading = false
            console.log(err)
          })
        }
   
    }
    
  }
</script>
