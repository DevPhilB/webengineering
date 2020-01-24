<xsl:stylesheet version="2.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">
  <xsl:output method="text" encoding="UTF-8" indent="yes" omit-xml-declaration="no"/>
  <xsl:template match="/">
    "description" : "<xsl:value-of select="prices/description" />",
    "prices" :
    <xsl:for-each select="prices/price">
    "name" : "<xsl:value-of select="name" />",
    "start" : "<xsl:value-of select="start" />",
    "end" : "<xsl:value-of select="end" />",
    "cost" : "<xsl:value-of select="cost" />"
    </xsl:for-each>
  </xsl:template>

</xsl:stylesheet>
