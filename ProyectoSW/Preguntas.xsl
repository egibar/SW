<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
<xsl:template match="/">
    <html>
        <head>
            <title>VerPreguntas</title>
        </head>
        <body>
            <table border="1">
                <tr>
                    <th>ENUNCIADO</th>
                    <th>COMPLEJIDAD</th>
                    <th>TEMATICA</th>
                    <th>RESPUESTA</th>
                </tr>
                <xsl:for-each select="/assessmentItems/assessmentItem">
                    <tr>
                        <td><xsl:value-of select="itemBody"/></td>
                        <td><xsl:value-of select="@complexity"/></td>
                        <td><xsl:value-of select="@subject"/></td>
                        <td><xsl:value-of select="correctResponse/value"/></td>
                    </tr>
                </xsl:for-each>
            </table>
        </body>
    </html>
</xsl:template>
</xsl:stylesheet>