<template lang="pug">
  div.rvz-txt {{{ diff }}}
</template>

<script>
var DMP = new diff_match_patch()
export default {
  props: ['baseline', 'revision'],
  data () {
    return {
    }
  },
  computed: {
    diff () {
      var diffs = DMP.diff_main(this.baseline.post_content, this.revision.post_content)
      DMP.diff_cleanupSemantic(diffs)
      return this.textToHtml(diffs)
    }
  },
  methods: {
    textToHtml (diffs) {
      var html = []
      for (var x = 0; x < diffs.length; x++) {
        var op = diffs[x][0]    // Operation (insert, delete, equal)
        var data = diffs[x][1]   // Text of change.
        switch (op) {
          case DIFF_INSERT:
            html[x] = '<ins>' + data.replace(/\r\n\r\n/g, '</ins></p><p><ins>') + '</ins>'
            break
          case DIFF_DELETE:
            html[x] = '<del>' + data.replace(/\r\n\r\n/g, '</del></p><p><del>') + '</del>'
            break
          case DIFF_EQUAL:
            html[x] = data.replace(/\r\n\r\n/g, '</p><p>')
            break
        }
      }
      return '<p>' + html.join('') + '</p>'
    }
  }
}
</script>

<style lang="sass">
.rvz-txt
  margin-top: 24px
ins
  text-decoration: none
  background: #e6ffe6
del
  background: #ffe6e6
</style>
