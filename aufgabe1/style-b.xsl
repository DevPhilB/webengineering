<xsl:stylesheet version="2.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="text" encoding="UTF-8" indent="yes" omit-xml-declaration="yes"/>

<!-- XML to JSON Transformation -->
<xsl:template match="prices">{
    "prices": {
      "description": "<xsl:value-of select="description"/>",
      "price": [<xsl:for-each select="price">
        {
          "name": "<xsl:value-of select="name"/>",
          "start": "<xsl:value-of select="start"/>",
          "end": "<xsl:value-of select="end"/>",
          "cost": "<xsl:value-of select="cost"/>"
        }</xsl:for-each>
      ]
    }
}
</xsl:template>
</xsl:stylesheet>