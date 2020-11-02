<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      max-width="290"
    >
      <v-card>
        <v-card-title class="headline">
            Delete
        </v-card-title>

        <v-card-text>
            Do you really want to remove the Campus?
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="hideDialog()"
          >
            Cancel
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="deleteCampus()"
          >
            Yes
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props : ['campus_id', 'deleteDialog', 'authUser'],
    data () {
      return {  
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
          if(this.deleteDialog) {
              return this.deleteDialog
          } else {
              return false
          }
      },
    },
    methods : {
        hideDialog() {
            this.$parent.$emit('hide_delete_dialog')
        },
        deleteCampus() {
            axios.delete('/api/campuses/' + this.campus_id, this.config)
            .then(res => {
                if(res.data.message) {
                  this.$parent.$emit('campus_deleted', res.data.message)
                } else {
                  this.$parent.$emit('campus_deleted', 'Selected campus is already deleted.')
                }
            }).catch(err => console.log(err))
        }
        
    }
  }
</script>