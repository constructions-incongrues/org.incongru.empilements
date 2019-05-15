/**
 * Layout component that queries for data
 * with Gatsby's StaticQuery component
 *
 * See: https://www.gatsbyjs.org/docs/static-query/
 */

import "../stylesheets/gradient.css"
import "../stylesheets/layout.css"
import "../stylesheets/lib/960.gs/960.css"
import "../stylesheets/lib/960.gs/reset.css"
import "../stylesheets/lib/960.gs/text.css"
import "../stylesheets/magic.css"
import { StaticQuery, graphql } from "gatsby"
import {Helmet} from "react-helmet";
import Img from "gatsby-image"
import PropTypes from "prop-types"
import React from "react"

const Layout = ({ children }) => (
  <StaticQuery
    query={graphql`
      query LayoutQuery {
        logoImage: file(relativePath: { eq: "logo.png" }) {
          childImageSharp {
            fixed {
              ...GatsbyImageSharpFixed
            }
          }
        }
        handImage: file(relativePath: { eq: "navbar/hand.png" }) {
          childImageSharp {
            fixed(width: 89) {
              ...GatsbyImageSharpFixed
            }
          }
        }
        contents: directusContent {
          about
          sidebar
        }
      }
    `}
    render={data => (
      <>
        <head>
          <Helmet>
            <meta charSet="utf-8" />
            <meta name="viewport" content="width=device-width,initial-scale=1" />
            <title>Les Empilements Incongrus</title>
            <link rel="canonical" href="https://empilements.incongru.org" />
            <link rel="shortcut icon" type="image/png" href="src/images/icons/empilements_16x16.png" />
            <link rel="shortcut icon" href="src/images/icons/favicon.ico" />
            <link rel="apple-touch-icon" href="src/images/icons/apple-touch-icon.png" />
            <link rel="alternate" type="application/rss+xml" title="Se tenir informer des nouvelles sorties" href="//feeds.feedburner.com/empilements-incongrus" />
            <link href='//fonts.googleapis.com/css?family=Terminal+Dosis:400,500,600,700,800' rel='stylesheet' type='text/css' />
          </Helmet>
        </head>

        <body>
          <div className="container_12">
            <h1 className="grid_6 logo">
              <a href="#TODO" title="Retourner à la page d'accueil">
                <Img fixed={data.logoImage.childImageSharp.fixed} title="Le logo du site" />
              </a>
            </h1>
            <div className="clear"></div>
            <div className="grid_4 navbar grad-1">
              <p className="bgfix">e</p>
              <div className="man">
                <p
                  className="descr grad-3"
                  dangerouslySetInnerHTML={{ __html:data.contents.about }}
                >
                </p>
              </div>
              <Img fixed={data.handImage.childImageSharp.fixed} title="Un pouce levé" className="hand" />
              <p className="submit">N'hésitez surtout pas à <br/>nous soumettre vos <br/>compilations !</p>
              <div className="triangle"></div>
              <div className="footer grad-2">
                <h2 className="go"><a href="mailto:empilements@incongru.org">Go! &gt;&gt;&gt;</a></h2>
                <p>
                  <strong>Consulter le <a href="https://www.google.com/calendar/embed?src=3s3432r73c0k5scnvb6sruvp08%40group.calendar.google.com&amp;ctz=Europe/Paris">calendrier</a> des sorties</strong>
                </p>

                <p>
                  Ce projet est développé par
                  <a href="">Constructions Incongrues </a>
                  et hébergé par <a href="">Pastis Hosting</a>
                  </p>

                <p>
                  Le code source est <a href="https://github.com/constructions-incongrues/empilements">diffusé</a> sous license <a href="http://www.gnu.org/licenses/agpl-3.0.html">AGPLv3</a>.
                </p>

                <p>Design par <a href="http://www.blogdamned.com/">Goupil Acnéique</a></p>
                <p>Être tenu au courant des nouveautés <a href="http://feeds.feedburner.com/empilements-incongrus">RSS</a> | <a href="http://feedburner.google.com/fb/a/mailverify?uri=empilements-incongrus&amp;loc=fr_FR">Email</a> | <a href="http://www.facebook.com/empilements">Facebook</a></p>
              </div>
            </div>

            <main>{children}</main>

          </div>
        </body>
      </>
    )}
  />
)

Layout.propTypes = {
  children: PropTypes.node.isRequired,
}

export default Layout
