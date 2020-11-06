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
            
            List of Programs
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
            :items="programs"
            :search="search"
          >
          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click.stop="showDialog=true, edit=true, editProgram(item.id)"
              >
                  mdi-pencil
              </v-icon>

              <v-icon
                  color="red"
                  small
                  @click="deleteProgram(item.id)"
              >
                  mdi-delete
              </v-icon>

          </template>
          
          </v-data-table>
        </v-card>
      </v-container>
    </v-app>
    <AddProgram :showDialog="showDialog" :program1="program" :edit="edit" :authUser="authUser" />
  </div>
</template>

<script>
  import AddProgram from "./children/AddProgram"
  export default {
    mounted () {

      this.$on('hide_dialog', () => {
          this.showDialog = false
      })

      this.$on('program_added', (message) => {
          this.fetchPrograms()
          this.edit = false
          this.message = message
          this.snackbar = true
          this.showDialog = false
      })


    },
    components : {
      AddProgram
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
        programs : [],
        program : {
          id : '',
          name : ''
        },
        headers: [
          { text: 'ID', value: 'id' },
          { text: 'Name', value: 'name' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        
      }
    },
    created() {
      this.fetchPrograms();
    },
    methods: {
      fetchPrograms() {
        axios.get('/api/programs', this.config)
        .then(res => this.programs = res.data)
        .catch(err => console.log(err))
      },
      deleteProgram(id) {
        axios.delete('/api/programs/' + id, this.config)
        .then(res => {
          this.fetchPrograms()
          this.message = "Selected program deleted successfully"
          this.snackbar = true        
        }).catch(err => console.log(err))
      },
      editProgram(id) {
        axios.get('/api/programs/' + id, this.config)
        .then(res => {
          this.program = res.data
        })
        .catch(err => console.log(err))
      }
    } 
  }
</script>