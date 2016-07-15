<template lang="pug">
  div.rvz
    controls(v-bind:revisions="revisions" v-bind:baseline.sync="baseline" v-bind:revision.sync="revision")
    content(v-bind:baseline="baseline" v-bind:revision="revision")
</template>

<script>
import Controls from './Controls.vue'
import Content from './Content.vue'
export default {
  props: ['jrevisions'],
  components: { Controls, Content },
  data () {
    return {
      baseline: {},
      revision: {}
    }
  },
  computed: {
    revisions () {
      // Parse JSON
      const revisionsObject = JSON.parse(this.jrevisions)
      // Transform object of revisions into array of revisions
      const revisionsArray = Object.keys(revisionsObject).map((key) => {
        return revisionsObject[key]
      })
      return revisionsArray
    }
  }
}
</script>

<style lang="sass">
.rvz
  margin: 0
  padding: 0
</style>
