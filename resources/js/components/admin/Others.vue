<template>
  <div>
    <v-app>

      <div class="text-center">
        <v-snackbar
          v-model="snackbar"
          :timeout="timeout"
        >
          {{ message }}

          <template v-slot:action="{ attrs }">
            <v-btn
              color="blue"
              text
              v-bind="attrs"
              @click="snackbar = false"
            >
              Close
            </v-btn>
          </template>
        </v-snackbar>
      </div>

      <v-container>
        <v-card>
          <v-card-title>
            
            Other Documents
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
            
          </v-card-title>      

          <v-btn class="mx-2 my-2" fab dark color="indigo" @click.stop="showDialog = true">
            <v-icon dark>mdi-plus</v-icon>
          </v-btn>

          <v-data-table
            :headers="headers"
            :items="otherdocuments"
            :search="search"
          >

          <template v-slot:item.file="{ item }">

              <a :href="'/storage/' + item.file" target="new">
                <v-icon
                    color="primary"
                >
                    mdi-link
                </v-icon>
              </a>

          </template>
          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click.stop="edit = true, showDialog = true, editDocument(item.id)"
              >
                  mdi-pencil
              </v-icon>

              <v-icon
                  color="red"
                  small
                  @click="deleteDocument(item.id)"
              >
                  mdi-delete
              </v-icon>

          </template>
          
          </v-data-table>
        </v-card>
      </v-container>
    </v-app>
    <AddOtherDocument :authUser="authUser" :showDialog="showDialog" :otherdocument="otherdocument" :edit="edit"  />
  </div>
</template>

<script>
  import AddOtherDocument from "./children/AddOtherDocument"
  export default {
    mounted() {
      this.$on('hide_dialog', () => {
          this.edit = false
          this.showDialog = false
      });

      this.$on('document_added', (message) => {
          this.snackbar = true
          this.message = message
          this.fetchOtherDocuments()
          this.showDialog = false
      });
      
      this.$on('document_updated', (message) => {
          this.snackbar = true
          this.message = message
          this.edit = false
          this.fetchOtherDocuments()
          this.showDialog = false
      });
    },
    components : {  
      AddOtherDocument
    },
    props : ['authUser'],
    data () {
      return {
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
        edit : false,
        snackbar: false,
        message: '',
        timeout: 3000,
        showDialog : false,
        search: '',
        otherdocuments : [],
        otherdocument : {
          'name' : '',
          'file' : ''
        },
        headers: [
          { text: 'Name', value: 'name' },
          { text: 'Documents', value: 'file', sortable: false },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        
      }
    },

    created() {
      this.fetchOtherDocuments();
    },
    methods : {
      fetchOtherDocuments() {
         axios.get('/api/other-documents', this.config)
        .then(res => this.otherdocuments = res.data)
        .catch(err => console.log(err))
      },
      deleteDocument(id) {
         axios.delete('/api/other-documents/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchOtherDocuments()
        })
        .catch(err => console.log(err))
      },
      editDocument(id) {
        axios.get('/api/other-documents/' + id, this.config)
        .then(res => this.otherdocument = res.data)
        .catch(err => console.log(err))
      }
    }
  
  
  }
</script>