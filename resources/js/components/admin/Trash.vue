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
        <h1>Trash</h1>

        <v-card class="my-2">
          <v-card-title>
            
            Users
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
            
          </v-card-title>     

          <v-data-table
            :headers="headers_users"
            :items="trash_users"
            :search="search"
          >

          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click="restoreUser(item.id)"
              >
                  mdi-restore 
              </v-icon>

              <v-icon
                  small
                  class="mr-2"
                  color="red"
                  @click="deleteUser(item.id)"
              >
                  mdi-delete 
              </v-icon>
              
          </template>
          
          </v-data-table>
        </v-card>

         <v-card class="my-2">
          <v-card-title>
            
            Campus
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
            
          </v-card-title>     

          <v-data-table
            :headers="headers_campus"
            :items="trash_campuses"
            :search="search"
          >

           <template v-slot:item.image="{ item }">
                <v-img :src="'/storage/' + item.image" alt="image" width="100px" height="60px" class="m-2"></v-img>
          </template>

          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click="restoreCampus(item.id)"
              >
                  mdi-restore 
              </v-icon>

              <v-icon
                  small
                  class="mr-2"
                  color="red"
                  @click="deleteCampus(item.id)"
              >
                  mdi-delete 
              </v-icon>
              
          </template>
          
          </v-data-table>
        </v-card>

        <v-card class="my-2">
          <v-card-title>
            
            Programs
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
            
          </v-card-title>     

          <v-data-table
            :headers="headers_programs"
            :items="trash_programs"
            :search="search"
          >

          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click="restoreProgram(item.id)"
              >
                  mdi-restore 
              </v-icon>

              <v-icon
                  small
                  class="mr-2"
                  color="red"
                  @click="deleteProgram(item.id)"
              >
                  mdi-delete 
              </v-icon>
              
          </template>
          
          </v-data-table>
        </v-card>


      </v-container>
    </v-app>
  </div>
</template>

<script>
  import AddProgram from "./children/AddProgram"
  export default {
  
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
        trash_campuses : [],
        trash_programs : [],
        trash_users : [],
        headers_campus: [
          { text: 'Image', value: 'image' },
          { text: 'College/Campuses', value: 'name' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],

         headers_programs: [
          { text: 'ID', value: 'id' },
          { text: 'Program', value: 'name' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],

        headers_users: [
          { text: 'Name', value: 'name' },
          { text: 'Email', value: 'email' },
          { text: 'Role', value: 'role' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        
      }
    },
    created() {
      this.fetchTrashCampuses()
      this.fetchTrashPrograms()
      this.fetchTrashUsers();
      
    },
    methods : {
      fetchTrashCampuses() {
        axios.get('/api/trash-campuses', this.config)
        .then(res => this.trash_campuses = res.data)
        .catch(err => console.log(err))
      },
      fetchTrashPrograms() {
        axios.get('/api/trash-programs', this.config)
        .then(res => this.trash_programs = res.data)
        .catch(err => console.log(err))
      },
      fetchTrashUsers() {
        axios.get('/api/trash-users', this.config)
        .then(res => this.trash_users = res.data)
        .catch(err => console.log(err))
      },
      restoreCampus(id) {
        axios.patch('/api/trash-campuses/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchTrashCampuses()
        })
        .catch(err => console.log(err))
      },
      restoreProgram(id) {
        axios.patch('/api/trash-programs/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchTrashPrograms()
        })
        .catch(err => console.log(err))
      },
      restoreUser(id) {
        axios.patch('/api/trash-users/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchTrashUsers()
        })
        .catch(err => console.log(err))
      },
      deleteCampus(id) {
        axios.delete('/api/trash-campuses/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchTrashCampuses()
        })
        .catch(err => console.log(err))
      },
      deleteProgram(id) {
        axios.delete('/api/trash-programs/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchTrashPrograms()
        })
        .catch(err => console.log(err))
      },
      deleteUser(id) {
        axios.delete('/api/trash-users/' + id, this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchTrashUsers()
        })
        .catch(err => console.log(err))
      }
    }
    
    
  }
</script>