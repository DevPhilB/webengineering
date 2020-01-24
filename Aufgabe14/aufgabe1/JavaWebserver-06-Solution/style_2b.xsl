<xsl:stylesheet version="2.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="text" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>
  <xsl:template match="/">
    {
      "description" : "<xsl:value-of select="prices/description" />",
      "prices" : [ <xsl:apply-templates select="prices/price" />
      ]
    }
  </xsl:template>

  <xsl:template match="prices/price">
        {
          "name" : "<xsl:value-of select="name" />",
          "start" : "<xsl:value-of select="start" />",
          "end" : "<xsl:value-of select="end" />",
          "cost" : "<xsl:value-of select="cost" />"
        }<xsl:if test="position() != last()">
    <xsl:text>,</xsl:text>
  </xsl:if>
  </xsl:template>

</xsl:stylesheet>
