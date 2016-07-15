<template lang="pug">
  div(v-bind:class="{ 'rvz-ctl-pinned' : pinned }").rvz-ctl.entry-meta
    div.rvz-ctl-title Browse changes
    div.rvz-ctl-versions
      div.rvz-ctl-baseline
        div.rvz-ctl-label From:
        div.rvz-ctl-meta v{{ baseline.ID }} - {{ prettyDate(baseline.post_date) }}
        div.rvz-ctl-slider
          div(v-for="revision in revisions" @click="selectBaseline(revision)" v-bind:class="{ 'rvz-ctl-slider-nob-selected' : isCurrentBaseline(revision.ID) }").rvz-ctl-slider-nob
          div.rvz-ctl-slider-track
      div.rvz-ctl-new
        div.rvz-ctl-label To:
        div.rvz-ctl-meta v{{ revision.ID }} - {{ prettyDate(revision.post_date) }}
        div.rvz-ctl-slider
          div(v-for="revision in revisions" @click="selectRevision(revision)" v-bind:class="{ 'rvz-ctl-slider-nob-selected' : isCurrentRevision(revision.ID) }").rvz-ctl-slider-nob
          div.rvz-ctl-slider-track
    //- div(@click="toggle" v-bind:class="{ 'rvz-ctl-pin-pinned' : pinned }").rvz-ctl-pin Pin me
</template>

<script>
export default {
  props: ['revisions', 'revision', 'baseline'],
  ready () {
    this.$set('baseline', this.revisions[this.revisions.length - 1])
    this.$set('revision', this.revisions[this.revisions.length - 1])
  },
  data () {
    return {
      pinned: false
    }
  },
  methods: {
    selectBaseline (baseline) {
      this.$set('baseline', baseline)
    },
    selectRevision (revision) {
      this.$set('revision', revision)
    },
    isCurrentBaseline (ID) {
      return ID === this.baseline.ID
    },
    isCurrentRevision (ID) {
      return ID === this.revision.ID
    },
    prettyDate (date) {
      return new Date(date).toDateString()
    },
    toggle () {
      this.$set('pinned', !this.pinned)
    }
  }
}
</script>

<style lang="sass">
.rvz-ctl
  box-sizing: border-box
  width: 100%
  &-versions, &-pin
    display: inline-block
  &-title
    line-height: 1.5em
    font-weight: bold
  &-new, &-baseline
    line-height: 1.5em
  &-label
    display: inline-block
    width: 50px
  &-meta
    display: inline-block
    width: 150px
  &-slider
    position: relative
    display: inline-block
    line-height: 1.5em
    &-nob
      position: relative
      display: inline-block
      width: 8px
      height: 8px
      z-index: 1000
      margin: 0
      cursor: pointer
      border-radius: 999em
      background: #ddd
      &:not(:first-child)
        margin-left: 1.5em
      &:hover
        background: #ccc
        transform: scale(1.2)
        transition: transform 0.1s ease-in
      &-selected
        background: #767676
    &-track
      position: absolute
      top: 50%
      width: 100%
      height: 1px
      z-index: 100
      background: #ddd
      transform: translateY(-1px)
  &-pin
    margin-left: 1rem
    padding: 10px
    cursor: pointer
    background: #edf6ff
    border-radius: 5px
    &:hover, &-pinned
      background: #c6e3ff

.rvz-ctl-pinned
  position: fixed
  top: 30px
  left: 20px
  z-index: 100000
  padding: 5px 10px
  background: #fff
  border-radius: 5px
</style>
