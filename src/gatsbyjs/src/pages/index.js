import React from "react"
import { graphql } from "gatsby"
import Layout from "../components/layout"

export default ({ data }) => (
  <Layout>
  </Layout>
)

export const query = graphql`
  query Empilements {
    allDirectusEmpilement(sort:{fields:[published_on], order:DESC}) {
      edges {
        node {
          directusId
          title
          published_on
          cover {
            filename
          },
          curators {
            name
          }
          tracks {
            artists {
              name
            }
          }
        }
      }
    }
  }
`
