<template>
    <v-app id="inspire">
      <v-navigation-drawer
        v-model="drawer"
        app
      >
      
        <v-list dense>

          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-arrow-left</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Homepage</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          
          <v-sheet
            color="grey lighten-5"
            class="pa-4 text-center"
        >
            <v-avatar
            class="mb-4"
            color="grey darken-1"
            size="64"
            ></v-avatar>

            <div>Administrator</div>
        </v-sheet>


          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-shape</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-account-group</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Users</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

           <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-school</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Campuses</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-logout</v-icon>
            </v-list-item-action>
            <v-list-item-content @click="logout">
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
        
      </v-navigation-drawer>
    
        

      <v-app-bar
        app
        color="green"
        dark
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Dashboard</v-toolbar-title>
      </v-app-bar>
  
      <v-main>
        <v-container
          class="fill-height"
          fluid
        >
          <v-row
            align="center"
            justify="center"
          >
            <v-col class="text-center">
              <v-tooltip left>
                <template v-slot:activator="{ on }">
                  <v-btn
                    :href="source"
                    icon
                    large
                    target="_blank"
                    v-on="on"
                  >
                    <v-icon large>mdi-code-tags</v-icon>
                  </v-btn>
                </template>
                <span>Source</span>
              </v-tooltip>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
      <v-footer
        color="green"
        app
      >
        <span class="white--text">CvSU - IDO &copy; {{ new Date().getFullYear() }}</span>
      </v-footer>
    </v-app>
</template>
<script>
export default {
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
    }),
    methods: {
        logout() {
            axios.post('/logout')
            .then(res => {
                window.location.href = '/';
            }).catch(err => console.log(err))
        }
    }
}
</script>